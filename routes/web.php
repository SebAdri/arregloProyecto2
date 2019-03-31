<?php

//Rutas
Route::get('home', ['as' => 'home', 'uses'=>'PagesController@home']);
Route::get('usersRole', ['as'=> 'userRole', 'uses' => 'PagesController@loadAdministrationView']);
Route::get('subMant', ['as'=> 'subMant', 'uses' => 'PagesController@loadMantenedores']);
Route::get('almacen', ['as'=> 'almacen', 'uses' => 'PagesController@loadStore']);


//Login y Logout
Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
// Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

//REST Users
Route::resource('users', 'UsersController');

//REST Roles
Route::resource('roles', 'RolesController');

//REST Empleados
Route::resource('empleados', 'EmpleadosController');

//REST Documents
Route::resource('documentos', 'DocumentosController');

//REST Obras
Route::resource('obras', 'ObrasController');

//REST Rubros
Route::resource('rubros', 'RubrosController');

//REST Materiales
Route::resource('materiales', 'MaterialesController');

//REST Maquinarias
Route::resource('maquinarias', 'MaquinariasController');

//REST Herramientas
Route::resource('herramientas', 'HerramientasController');

//REST Clientes
Route::resource('clientes', 'ClientesController');

//REST Almacenes
// Route::resource('storages', 'StoragesController');

//EmpleadosObras
Route::post('empleadosObras/{id}', ['as' => 'empleadosObras', 'uses'=>'EmpleadosObrasController@asignarEmpleadoObra']);

//Desvincular empleado de obra
Route::get('desvincular/{obra}/{id}', ['as' => 'desvincular', 'uses'=>'ObrasController@desvincular']);

// Route::get('almacen', '';

//REST Almacenes
Route::resource('almacenGeneral', 'AlmacenGeneralController');

//HerramientasObras
// Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'HerramientasObrasController@asignarHerramientaObra']);
 Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'AlmacenGeneralController@asignarHerramientaObra']);
 
//MaquinariasObras
 Route::post('maquinariasObras/{id}', ['as' => 'maquinariasObras', 'uses'=>'AlmacenGeneralController@asignarMaquinariaObra']);

//MaterialeObras
 Route::post('materialesObras/{id}', ['as' => 'materialesObras', 'uses'=>'AlmacenGeneralController@asignarMaterialObra']);


//REST Facturas
//Route::resource('facturasGestion', 'FacturasGestionController');