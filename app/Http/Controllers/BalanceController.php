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
        // Datos del usuario actual
        $user = auth()->user();
         
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
        
        // $details = [
        //     'title' => 'Title: Mail from Real Programmer',
        //     'body' => 'Body: This is for testing email using smtp'
        // ];

        // Mail::to('siddharthshukla089@gmail.com')->send(new EnviarBalance($details)); 

        // Avisos a slack y email 
        if ($total < 25000) {
            Log::critical("El balance del usuario con el email '" . $user->email . "' ha bajado de $25000. ");
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
