<?php

namespace App\Http\Controllers;

use App\Egresos;
use Illuminate\Http\Request;
use App\CategoriasIng;
use App\ItemsEgresos;
use GuzzleHttp\Client;

class EgresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Me va a ser util desde las vistas para hacer peticiones a la API
        //$this->cliente = new Client(['base_uri'=>'http://localhost:8002/api/']);
        $this->cliente = new Client(['base_uri'=>'http://localhost/laravel/balance/public/api/']);
    }

    public function index()
    {
        //
        $respuesta = $this->cliente->get('egresos');
        $cuerpo = $respuesta->getBody();    

        $respuestaItems = $this->cliente->get('itemsegresos');
        $cuerpoItems = $respuestaItems->getBody();    
 
        $itemsEgresos = ItemsEgresos::all();  
        return view('egresos.index',['egresos' => json_decode($cuerpo)],['items' => json_decode($cuerpoItems)],['items' => (json_decode($itemsEgresos))] );   
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
        
        $hayCategoria = false; 
        foreach ($categorias as $categoria) {
            if ($categoria->subcategorias_id == 2) {
                $hayCategoria = true;
            }
        }

        if ($hayCategoria) {
            return view('egresos.create',compact('categorias'));
        }else{
            return view('egresos.create');
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
        //
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
        $this->cliente->post('egresos', [
            'json' => $request->all()
        ]); 

        return redirect('egresos')->with('Mensaje','Egreso agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Egresos  $egresos
     * @return \Illuminate\Http\Response
     */
    public function show(Egresos $egresos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Egresos  $egresos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Traigo los datos del ingreso 
         $respuesta = $this->cliente->get('egresos/' . $id);
         $cuerpoEgreso = $respuesta->getBody();    
         $egreso = json_decode($cuerpoEgreso);       
         $egreso = $egreso->data;
 
         // Traigo los datos de categorias  
         $respuesta = $this->cliente->get('categorias');
         $cuerpoCategorias = $respuesta->getBody();    
         $categorias = json_decode($cuerpoCategorias);       
         $categorias = $categorias->data; 
 
         // compact -> crea un conjunto de info a traves de una variable
         return view('egresos.edit',compact('egreso','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Egresos  $egresos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre' => 'required|string|max:100', 
            'detalle' => 'required|string|max:100', 
            'valor' => 'required|string|max:100', 
            'categorias_ings_id' => 'required|max:100', 
        ];
        //$Mensaje = ["required"=>'El :attribute es requerido'];
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        $this->cliente->put('egresos/' . $id , [
            'json' => $request->all()
        ]);
        
         return redirect('/egresos')->with('Mensaje','Egreso editado correctamente');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Egresos  $egresos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cliente->delete('egresos/' . $id);
        return back()->with('Mensaje','Egreso eliminado correctamente');
    }
}
