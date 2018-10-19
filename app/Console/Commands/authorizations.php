<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserRequest;

class authorizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accept:authorizations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automazación para aceptar o rechazar solicitudes de credito';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //obtencion de registros esperando aprobacion
        $data = UserRequest::with('request.term')
            ->with('request.term')
            ->where('status',0)
            ->get();

        foreach($data as $item) {
            $status = 2;

            //validacion para autorizacion
            if($item->request->age >= 20 && $item->request->credit_card == 1) {
                $status = 1;
            }

            //obtencion de registro individual
            //para posteriormente actualizar el status
            //y almacenar en base de datos
            $user_request = UserRequest::firstOrNew(['id' => $item->id]);

            $user_request->status = $status;
            $user_request->save();
        }
    }
}
