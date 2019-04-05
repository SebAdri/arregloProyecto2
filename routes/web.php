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
Route::resource('rubros', 'FamiliaRubrosController');
Route::post('storeFliaRubros', 'FamiliaRubrosController@storeFliaRubros');
// Route::get('addRubros/{id}', 'FamiliaRubrosController@addRubros');
// Route::get('addRubros/{id}', ['as' => 'addRubros', 'uses'=>'FamiliaRubrosController@addRubros']);


//REST Profesiones
Route::resource('profesiones', 'ProfesionesController');

//REST Materiales
Route::resource('materiales', 'MaterialesController');

//REST Maquinarias
Route::resource('maquinarias', 'MaquinariasController');

//REST Herramientas
Route::resource('herramientas', 'HerramientasController');

//REST Clientes
Route::resource('clientes', 'ClientesController');

//REST Almacenes
Route::resource('storages', 'StoragesController');

//EmpleadosObras
Route::post('empleadosObras/{id}', ['as' => 'empleadosObras', 'uses'=>'EmpleadosObrasController@asignarEmpleadoObra']);

//Desvincular empleado de obra
Route::get('desvincular/{obra}/{id}', ['as' => 'desvincular', 'uses'=>'ObrasController@desvincular']);

// Route::get('almacen', '';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

Route::resource('almacen', 'AlmacenController');
Route::post('updatePedido', ['as'=>'updatePedido' , 'uses' =>  'AlmacenController@updatePedido']);
Route::post('almacenMateriales', ['as'=>'almacenMateriales', 'uses' => 'searchController@getMateriales']);

=======
>>>>>>> remotes/origin/master
=======

Route::resource('almacen', 'AlmacenController');
Route::post('almacenMateriales' , ['as'=> 'almacenMateriales', 'uses' => 'AlmacenController@getMateriales']);
>>>>>>> 02f58b56fb1bee2f0dbe21ca237daa1a9d237e90
=======
>>>>>>> 12bf9022b901a4cbc29d6de78d1ade0d9f735312
=======

Route::resource('almacen', 'AlmacenController');
Route::post('almacenMateriales' , ['as'=> 'almacenMateriales', 'uses' => 'AlmacenController@getMateriales']);
>>>>>>> 9f571b992552c9d5a2d75148a7865f44c8095ffa

//REST Almacenes
Route::resource('almacenGeneral', 'AlmacenGeneralController');

//HerramientasObras
// Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'HerramientasObrasController@asignarHerramientaObra']);
 Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'AlmacenGeneralController@asignarHerramientaObra']);
 
//MaquinariasObras
 Route::post('maquinariasObras/{id}', ['as' => 'maquinariasObras', 'uses'=>'AlmacenGeneralController@asignarMaquinariaObra']);

//MaterialesObras
 Route::post('materialesObras/{id}', ['as' => 'materialesObras', 'uses'=>'AlmacenGeneralController@asignarMaterialObra']);
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> remotes/origin/master
=======
>>>>>>> 12bf9022b901a4cbc29d6de78d1ade0d9f735312


//REST Facturas
// Route::resource('facturasGestion', 'FacturasGestionController');

//REST Tipos de documentos
Route::resource('tipos_documentos', 'TiposDocumentosController');