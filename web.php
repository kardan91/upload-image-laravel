<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('index');
});
*/
Route::get('/', [
    'uses' => 'PueblosMagicosController@buscarListas',
    'as' => 'buscarListasBusqueda'
]);

Route::group(['middleware' => 'turista'], function () {
    Route::get('/editarperfil', 'UsuarioController@editarPerfil');   
    Route::post('/actualizardatosturista', 'UsuarioController@actualizarDatosTurista');

    Route::post('/actualizardireccionturista', 'UsuarioController@actualizarDireccionTurista');

    Route::post('/actualizarpasswordturista', 'UsuarioController@actualizarPasswordTurista');

    Route::post('/verificarusername', 'UsuarioController@revisarUsername');
    Route::post('/verificarpassword', 'UsuarioController@revisarPassword'); 
}); 


Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es|pt-BR'
    ]);

//Auth::routes();
    // Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/respuesta', function(){
	return view('respuesta');
});

Route::get('activacion/{code}', 'UsuarioController@activate');

Route::get('activacion/municipio/{id}','UsuarioController@getMunicipios');
Route::get('activacion/ciudad/{ide}/{idm}','UsuarioController@getCiudades');

Route::post('registrar', 'UsuarioController@registrar');

    // Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/busqueda', function(){
	return view('busqueda');
});

Route::get('/buscarTodos/{opc}', [
    'uses' => 'PueblosMagicosController@buscarTodos',
    'as' => 'buscarTodosPueblos'
]);

Route::post('/buscarTodos/{opc}', 'PueblosMagicosController@buscarTodos');

Route::get('/buscarTodos/actualizarVistas/{opc}', [
    'uses' => 'PueblosMagicosController@actualizarVistas',
    'as' => 'actualizarVistasPueblos'
]);

Route::get('/buscarTodos/buscarPorDatos/actualizarVistas/{opc}', [
    'uses' => 'PueblosMagicosController@actualizarVistas',
    'as' => 'actualizarVistasPueblos'
]);

Route::get('/buscarPorDatos/buscarPorDatos/actualizarVistas/{opc}', [
    'uses' => 'PueblosMagicosController@actualizarVistas',
    'as' => 'actualizarVistasPueblos'
]);

Route::get('/buscarPorDatos/actualizarVistas/{opc}', [
    'uses' => 'PueblosMagicosController@actualizarVistas',
    'as' => 'actualizarVistasPueblos'
]);

Route::get('/actualizarVistas/{opc}', [
    'uses' => 'PueblosMagicosController@actualizarVistas',
    'as' => 'actualizarVistasPueblos'
]);

Route::post('/actualizarVistas/{opc}', 'PueblosMagicosController@actualizarVistas');

Route::post('/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::get('/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::post('/buscarTodos/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::get('/buscarTodos/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::post('/buscarPorDatos/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::get('/buscarPorDatos/buscarPorDatos/{opc}', 'PueblosMagicosController@buscarPorDatos');

Route::get('/filtrarTipo/{tipotur}/{xedo}', 'PueblosMagicosController@filtrarTipo');

Route::get('/filtrarEdo/{tedo}', 'PueblosMagicosController@filtrarEdo');

Route::get('/buscarTiposTuris', 'PueblosMagicosController@buscarTiposTuris');

Route::get('/buscarTodos/verPueblo/{idpueblo}', 'PueblosMagicosController@obtenerPerfilPueblo');

Route::get('/buscarPorDatos/verPueblo/{idpueblo}', 'PueblosMagicosController@obtenerPerfilPueblo');

Route::get('/verPueblo/{idpueblo}', 'PueblosMagicosController@obtenerPerfilPueblo');





Route::post('/actualizarfototurista', 'UsuarioController@actualizarFotoPerfil');

Route::get('/filtrarTipo/{tipotur}', 'PueblosMagicosController@filtrarTipo');