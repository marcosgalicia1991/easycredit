<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRequest\UserRequestInterface;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    public function __construct(UserRequestInterface $user_request)
    {
        $this->repository = $user_request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_wait = $this->repository->getCountRequest();
        $this->user = Auth::user();
        $name_user = $this->user->email;
        return response()->json([
            'total' => $total_wait,
            'name' => $name_user,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        return $this->repository->getData($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->deleteRequest($id);
    }
}
