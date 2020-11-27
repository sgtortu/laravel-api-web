<?php

namespace App\Http\Controllers;
 
use App\ItemsEgresos;
use GuzzleHttp\Client; 
use Illuminate\Http\Request; 
class ItemsEgresosController extends Controller
{
    //
    public function __construct()
    {
        // Me va a ser util desde las vistas para hacer peticiones a la API
        //$this->cliente = new Client(['base_uri'=>'http://localhost:8002/api/']);
        $apiDireccion = config('api.ubicacion');
        $this->cliente = new Client(['base_uri'=>$apiDireccion]);

    }
   



    public function index()
    {  
        $respuesta = $this->cliente->get('itemsegresos');
        $cuerpo = $respuesta->getBody(); 
           
        return view('itemsegresos.index',['items' => json_decode($cuerpo)]);   
    
    }

    public function create()
    { 
        $respuesta = $this->cliente->get('egresos');
        $cuerpo = $respuesta->getBody();
        $egresos = json_decode($cuerpo)->data; 
 
        return view('itemsegresos.create',compact('egresos'));
        
    }

    public function store(Request $request)
    {  
        // Valor de cliente: "http://localhost/laravel/balance/public/api/ 
        // cliente+ingresos apunta a la funcion api_store

        // Validacion
        $campos = [
            'nombreitem' => 'required|string|max:100', 
            'cantidaditem' => 'required|max:100', 
            'egreso_id' => 'required|max:100', 
        ];
        //$Mensaje = ["required"=>'El :attribute es requerido'];
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        // Enviar datos  
        $this->cliente->post('itemsegresos', [
            'json' => $request->all()
        ]);
        
        // Retornar vista
        return back()->with('Mensaje','Item agregado correctamente'); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemsEgresos  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        // Traigo los datos del items 
        $respuesta = $this->cliente->get('itemsegresos/' . $id);
        $cuerpoItem = $respuesta->getBody();    
        $item = json_decode($cuerpoItem)->data;
 
        // Traigo los datos de egresos  
        $respuestaE = $this->cliente->get('egresos');
        $cuerpoEgreso = $respuestaE->getBody();    
        $egresos = json_decode($cuerpoEgreso)->data; 

        // compact -> crea un conjunto de info a traves de una variable
        return view('itemsegresos.edit',compact('item','egresos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ItemsEgresos  $item
     * @param  \App\ItemsEgresos  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        $campos = [
            'nombreitem' => 'required|string|max:100', 
            'cantidaditem' => 'required|max:100',   
        ]; 

        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
         
        $this->cliente->put('itemsegresos/' . $id , [
            'json' => $request->all()
        ]);
 
        return redirect('egresos')->with('Mensaje','Item editado correctamente'); 
    }

    public function destroy($id)
    {  
        $this->cliente->delete('itemsegresos/' . $id);
        return back()->with('Mensaje','Item eliminado correctamente');
    }





}
