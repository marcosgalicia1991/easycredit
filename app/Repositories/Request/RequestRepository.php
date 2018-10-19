<?php

namespace App\Repositories\Request;

use Illuminate\Contracts\Container\Container;
use App\Handlers\Request\RequestDataHandlerInterface;
use Illuminate\Support\Facades\Validator;
use App\Request;
use App\Repositories\UserRequest\UserRequestInterface;

class RequestRepository implements RequestInterface
{
    protected $model;
    protected $handler;

    /**
     * Constructor.
     *
     * @param  \Illuminate\Contracts\Container\Container $app
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->model = $app[Request::class];
        $this->handler = $app[RequestDataHandlerInterface::class];
        $this->user_request = $app[UserRequestInterface::class];
    }

    public function save(array $data) {

        //mesajes para validacion en caso de que no pasen la verificacion
        $messages = [
            'age.required' => 'La Edad es requerida.',
            'amount.required' => 'El Monto es requerido.',
            'term_id.required' => 'El plazo es requerido.',
        ];

        //reglas de validacion
        $rules = [
            'age' => 'required',
            'amount' => 'required',
            'term_id' => 'required',
        ];

        //ejecutar validacion
        $validator = Validator::make($data, $rules, $messages);

        //validacion para corroborar que no haya fallos
        if(!$validator->fails()) {
            //se obtiene el formato necesario para almacenar desde handler
            $request = $this->handler->prepare($data);

            //creacion del registro en base de datos
            $request_data = $this->model->create([
                'age' => $request['age'],
                'amount' => $request['amount'],
                'credit_card' => $request['credit_card'],
                'term_id' => $request['term_id'],
                'total_amount' => $request['total_amount'],
            ]);

            //llamada por almacenado en repositorio UserRequest
            //se le envia el id de la solicitud almacenada anteriormente
            $user_request = $this->user_request->save($request_data->id);
        }

        //retorna los mensajes
        return $validator->messages();
    }
}