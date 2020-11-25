<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Egresos;
use App\Ingresos;
use App\Mail\EnviarBalance; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // Traigo datos directamente del objeto
        $egresos = Egresos::all();
        $ingresos = Ingresos::all();
        
        // Calculos de ingresos y egresos
        $totalIngreso = 0 ;
        foreach ($ingresos as $ingreso) {
            $totalIngreso = $totalIngreso + $ingreso->valor; 
        }        
        $totalEgreso = 0;
        foreach ($egresos as $egreso) {
            $totalEgreso = $totalEgreso + $egreso->valor; 
        }
        $total = $totalIngreso - $totalEgreso;
        
        // Datos del usuario actual
        $user = auth()->user();
 
        $to_name =  $user->name;
        $to_email = $user->email;
        $data = array('name'=> $user->name, "body" => "Tu balance ha bajado de $25000. ");

        
        // Avisos a slack y email 
        if ($total < 25000) {
            // slack
            Log::critical("El balance del usuario con el email '" . $user->email . "' ha bajado de $25000. ");
        
            // email
            Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                        ->subject('Aviso de TortuMath');
                $message->from('technologyblog0@gmail.com','TortuMath');
            });

        }

        return view('balance.index',compact('ingresos','egresos','totalEgreso','totalIngreso'));

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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
