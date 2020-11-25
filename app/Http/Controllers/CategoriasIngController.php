<?php

namespace App\Http\Controllers;

use App\CategoriasIng;
use App\subcategorias;
use Illuminate\Http\Request; 
use GuzzleHttp\Client;

class CategoriasIngController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // Me va a ser util desde las vistas para hacer peticiones a la API
        $this->cliente = new Client(['base_uri'=>'http://localhost/laravel/balance/public/api/']);
    }

    public function index()
    { 
        $respuesta = $this->cliente->get('categorias');
        $cuerpo = $respuesta->getBody();   
 

        return view('categoriasing.index',['categoriasing' => json_decode($cuerpo)]); 
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $respuesta = $this->cliente->get('subcategorias');
        $cuerpo = $respuesta->getBody();
        $subcategorias = json_decode($cuerpo)->data;
        return view('categoriasing.create',compact('subcategorias'));
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
            'subcategorias_id' => 'required|max:100',  
        ];
        
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        
        $this->cliente->post('categorias', [
            'json' => $request->all()
        ]);
        
        return back()->with('Mensaje','Categoria agregada correctamente');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoriasIng  $categoriasIng
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriasIng $categoriasIng)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoriasIng  $categoriasIng
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        // Traigo los datos de categoria 
        $respuesta = $this->cliente->get('categorias/' . $id);
        $cuerpoCategoria = $respuesta->getBody();    
        $categoria = json_decode($cuerpoCategoria);       
        $categoriaIng = $categoria->data;

        // Traigo los datos de subcategorias  
        $respuesta = $this->cliente->get('subcategorias');
        $cuerpoSubCategorias = $respuesta->getBody();    
        $subCategorias = json_decode($cuerpoSubCategorias);       
        $subcategorias = $subCategorias->data; 
           
        return view('categoriasing.edit',compact('categoriaIng','subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoriasIng  $categoriasIng
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre' => 'required|string|max:100', 
            'detalle' => 'required|string|max:100',  
        ];
        //$Mensaje = ["required"=>'El :attribute es requerido'];
        $Mensaje = ["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        $this->cliente->put('categorias/' . $id , [
            'json' => $request->all()
        ]);
        
        
        
        return redirect('categoriasing')->with('Mensaje','Categoria editada correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoriasIng  $categoriasIng
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         // despues de borrar destruyo el registro que se borro
         $this->cliente->delete('categorias/' . $id);


         return redirect('categoriasing')->with('Mensaje','Categoria eliminada correctamente');
    }
}
