<?php

use App\Http\Controllers\IngresosController;
use App\Ingresos;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 

//Route::get('/ingresos',[IngresosController::class,'index']); 
// Route::post('/ingreso',[IngresosController::class,'store']); 
// Route::get('/ingresos/{id}',[IngresosController::class,'show']); 
// Route::put('/ingresos/{id}',[IngresosController::class,'update']); 
// Route::delete('/ingresos/{id}',[IngresosController::class,'destroy']); 

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::get('/ingresos', function (Request $request) {
//     return Ingresos::all(); 
// });

//Route::get('ingresos', 'IngresosController@mifuncionget')->except(['create','edit']); 
Route::get('ingresos', 'IngresosController@api_index'); 
Route::post('ingresos', 'IngresosController@api_store'); 
Route::get('ingresos/{id}', 'IngresosController@api_show'); 
Route::delete('ingresos/{id}', 'IngresosController@api_destroy'); 
Route::put('ingresos/{ingreso}', 'IngresosController@api_update'); 

Route::get('egresos', 'ApiEgresosController@index'); 
Route::post('egresos', 'ApiEgresosController@store'); 
Route::get('egresos/{id}', 'ApiEgresosController@show'); 
Route::delete('egresos/{id}', 'ApiEgresosController@destroy'); 
Route::put('egresos/{egreso}', 'ApiEgresosController@update'); 

Route::get('categorias', 'ApiCategoriasIngController@index'); 
Route::post('categorias', 'ApiCategoriasIngController@store'); 
Route::get('categorias/{id}', 'ApiCategoriasIngController@show'); 
Route::delete('categorias/{id}', 'ApiCategoriasIngController@destroy'); 
Route::put('categorias/{categoria}', 'ApiCategoriasIngController@update'); 

Route::get('subcategorias', 'ApiSubcategoriasController@index'); 
