<?php

namespace App\Http\Controllers;

use App\CategoriasIng;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class IngresosController extends Controller
{
 
    public function __construct()
    {  
        
        // Me va a ser util desde las vistas para hacer peticiones a la API
        //$this->cliente = new Client(['base_uri'=>'http://localhost:8002/api/']);
        $apiDireccion = config('api.ubicacion');
        $this->cliente = new Client(['base_uri'=>$apiDireccion]);

    }
   

    public function index()
    {  
        // Valor de cliente: "http://localhost/laravel/balance/public/api/ "
        $respuesta = $this->cliente->get('ingresos');
        $cuerpo = $respuesta->getBody();     
        return view('ingresos.index',[ 'ingresos' => json_decode($cuerpo)]);   
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    { 
        $respuesta = $this->cliente->get('categorias');
        $cuerpo = $respuesta->getBody();
        $categorias = json_decode($cuerpo);
 
        $categorias = $categorias->data;
        //die();
        $hayCategoria = false; 
        foreach ($categorias  as $categoria) {
            if ($categoria->subcategorias_id == 1) {
                $hayCategoria = true;
            }
        }

        if ($hayCategoria) {
            return view('ingresos.create',compact('categorias'));
        }else{
            return view('ingresos.create');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 
    public function store(Request $request)
    {  
        // Valor de cliente: "http://localhost/laravel/balance/public/api/ 
        // cliente+ingresos apunta a la funcion api_store

        // Validacion
        $campos = [
            'nombre' => 'required|string|max:100', 
            'detalle' => 'required|string|max:100', 
            'valor' => 'required|string|max:100', 
            'categorias_ings_id' => 'required|max:100', 
        ];
        //$Mensaje = ["required"=>'El :attribute es requerido'];
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        // Enviar datos  
        $this->cliente->post('ingresos', [
            'json' => $request->all()
        ]);
        
        // Retornar vista
        return back()->with('Mensaje','Ingreso agregado correctamente'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
  

    public function show($id)
    {
        // Desde la vista no hago uso de esta funcion nunca. 
        // Seria para mostrar un solo registro, desde la API esta disponible en api_show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
 
    public function edit($id)
    { 
        // Traigo los datos del ingreso 
        $respuesta = $this->cliente->get('ingresos/' . $id);
        $cuerpoIngreso = $respuesta->getBody();    
        $ingreso = json_decode($cuerpoIngreso);       
        $ingreso = $ingreso->data;

        // Traigo los datos de categorias  
        $respuesta = $this->cliente->get('categorias');
        $cuerpoCategorias = $respuesta->getBody();    
        $categorias = json_decode($cuerpoCategorias);       
        $categorias = $categorias->data; 

        // compact -> crea un conjunto de info a traves de una variable
        return view('ingresos.edit',compact('ingreso','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
 
    public function update(Request $request, $id)
    {  
        $campos = [
            'nombre' => 'required|string|max:100', 
            'detalle' => 'required|string|max:100', 
            'valor' => 'required|string|max:100', 
            'categorias_ings_id' => 'required|max:100', 
        ];
        //$Mensaje = ["required"=>'El :attribute es requerido'];
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
         // Valor de cliente: "http://localhost/laravel/balance/public/api/ 
        // cliente+ingresos apunta a la funcion api_store
        $this->cliente->put('ingresos/' . $id , [
            'json' => $request->all()
        ]);
        
        return redirect('/ingresos')->with('Mensaje','Ingreso editado correctamente'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */

  

    public function destroy($id)
    { 
        // Valor de cliente: "http://localhost/laravel/balance/public/api/ 
        // apunto a la funcion api_destroy
        $this->cliente->delete('ingresos/' . $id);
        return back()->with('Mensaje','Ingreso eliminado correctamente');
    }



}
