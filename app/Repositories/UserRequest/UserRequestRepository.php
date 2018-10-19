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
        //obtencion de datos del usuario que esta loggeado actualmente
        $this->user = Auth::user();

        //creacion del registro para UserRequest
        //con parametro request_id, user_id y estatus 0 (esperando aprobacion o rechazo)
        return $this->model->create([
            'request_id' => $request_id,
            'user_id' => $this->user->id,
            'status' => 0,
        ]);
    }

    public function getData($status) {
        //obtencion de datos del usuario que esta loggeado actualmente
        $this->user = Auth::user();

        //obtencion de registros en base al usuario y estatus
        //0 => esperando aprobacion, 1 => aceptado o rechazado
        //con la relaciones a requests y option_terms
        $data = $this->model
            ->with('request.term')
            ->where('user_id', $this->user->id)
            ->where('status', ($status == 0 ? "=":"!="),0)
            ->get();

        //iteracion para obtener datos especificamente necesarios
        $data = $data->map(function($item) {
            //se obtiene el monto total de la tabla request
            $item->amount = $item->request->total_amount;
            //se obtiene la descripcion del plazo en la tabla option_terms
            $item->description = $item->request->term->description;

            //se retorna solamente los atributos necesarios para front-end
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
        //obtencion de datos del usuario que esta loggeado actualmente
        $this->user = Auth::user();
        
        //obtención de registros UserRequest
        //con parametro  id de usuario y estatus 0 (esperando aprobacion o rechazo)
        return $this->model
            ->where('user_id', $this->user->id)
            ->where('status',0)
            ->count();
    }

    public function deleteRequest($id) {
        //obtencion de registros especifico
        //si hay registro se "elimina" con delete()
        $deleted = $this->model->find($id)->delete();

        return [$deleted];
    }
}