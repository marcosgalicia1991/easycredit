<?php

namespace App\Repositories\UserRequest;

use Illuminate\Contracts\Container\Container;
use App\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserRequestRepository implements UserRequestInterface
{
    protected $model;

    /**
     * Constructor.
     *
     * @param  \Illuminate\Contracts\Container\Container $app
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->model = $app[UserRequest::class];
    }

    public function save($request_id) {
        $this->user = Auth::user();

        return $this->model->create([
            'request_id' => $request_id,
            'user_id' => $this->user->id,
            'status' => 0,
        ]);
    }

    public function getData($status) {
        $this->user = Auth::user();

        $data = $this->model
            ->with('request.term')
            ->where('user_id', $this->user->id)
            ->where('status', ($status == 0 ? "=":"!="),0)
            ->get();

        $data = $data->map(function($item) {
            $item->amount = $item->request->total_amount;
            $item->description = $item->request->term->description;

            return $item->only([
                'id',
                'status',
                'amount',
                'description'
            ]);
        });

        return $data;
    }

    public function getCountRequest() {
        $this->user = Auth::user();
        
        return $this->model
            ->where('user_id', $this->user->id)
            ->where('status',0)
            ->count();
    }

    public function deleteRequest($id) {
        $deleted = $this->model->find($id)->delete();

        return [$deleted];
    }
}