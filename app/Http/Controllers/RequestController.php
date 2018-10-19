<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Request\RequestInterface;

class RequestController extends Controller
{
    public function __construct(RequestInterface $request)
    {
        $this->repository = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = $this->repository->save($request->all());

        if ($messages->isEmpty()) {
            return response()->json([
                'saved' => true,
            ], 200);
        }

        return response()->json([
            'messages' => $messages,
        ], 400);
    }
}
