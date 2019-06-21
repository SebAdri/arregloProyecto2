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
//REST Proyectos
Route::resource('proyectos', 'ProyectoController');
Route::get('calculoCosto/{id}', ['as'=>'calculoCosto', 'uses' => 'ProyectoController@calculoCostos']);

//REST Rubros
Route::resource('rubros', 'RubrosController');
Route::resource('familiaRubros', 'FamiliaRubrosController');
// Route::post('storeFlia', ['as' => 'storeFlia', 'uses'=>'FamiliaRubrosController@storeFliaRubros']);
Route::post('storeMateriales', ['as' => 'storeMateriales', 'uses'=>'FamiliaRubrosController@storeMateriales']);

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

Route::resource('almacen', 'AlmacenController');
Route::post('updatePedido', ['as'=>'updatePedido' , 'uses' =>  'AlmacenController@updatePedido']);
Route::get('comprasRealizadas', ['as'=>'comprasRealizadas' , 'uses' =>  'AlmacenController@comprasRealizadas']);
Route::get('pedidosRecibidos', ['as'=>'pedidosRecibidos' , 'uses' =>  'AlmacenController@pedidosRecibidos']);
Route::get('pedidosEnviados', ['as'=>'pedidosEnviados' , 'uses' =>  'AlmacenController@pedidosEnviados']);
Route::get('recepcionPedido', ['as'=>'recepcionPedido' , 'uses' =>  'AlmacenController@recepcionPedido']);
Route::get('recepcionPedido', ['as'=>'recepcionPedido' , 'uses' =>  'AlmacenController@recepcionPedido']);
Route::get('egresosRealizados', ['as'=>'egresosRealizados' , 'uses' =>  'AlmacenController@egresosRealizados']);
Route::get('recepcionCompra', ['as'=>'recepcionCompra' , 'uses' =>  'AlmacenController@recepcionCompra']);
Route::post('aceptarPedido', ['as'=>'aceptarPedido' , 'uses' =>  'AlmacenController@aceptarPedido']);
Route::post('gestionPedido', ['as'=>'gestionPedido' , 'uses' =>  'AlmacenController@gestionPedido']);

Route::post('registrarEgresos', ['as'=>'registrarEgresos' , 'uses' =>  'AlmacenController@registrarEgresos']);
Route::post('generarOrdenCompra', ['as'=>'generarOrdenCompra' , 'uses' =>  'AlmacenController@generarOrdenCompra']);
Route::post('almacenMateriales' , ['as'=> 'almacenMateriales', 'uses' => 'AlmacenController@getMateriales']);

//REST Almacenes
Route::resource('almacenGeneral', 'AlmacenGeneralController');

//HerramientasObras
// Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'HerramientasObrasController@asignarHerramientaObra']);
 Route::post('herramientasObras/{id}', ['as' => 'herramientasObras', 'uses'=>'AlmacenGeneralController@asignarHerramientaObra']);
 
//MaquinariasObras
 Route::post('maquinariasObras/{id}', ['as' => 'maquinariasObras', 'uses'=>'AlmacenGeneralController@asignarMaquinariaObra']);

//MaterialesObras
 Route::post('materialesObras/{id}', ['as' => 'materialesObras', 'uses'=>'AlmacenGeneralController@asignarMaterialObra']);


//REST Facturas
Route::resource('facturas', 'FacturasController');

//REST Tipos de documentos
Route::resource('tipos_documentos', 'TiposDocumentosController');
//REST Tipos de caclculo de costo de la obra
Route::resource('calculoCosto', 'CalculoCostoController');
//REST del avance de la obra
Route::resource('avance', 'AvanceController');
//REST de los pagos
Route::resource('pagos', 'PagoController');
Route::post('getPago',['as'=> 'getPago', 'uses' => 'PagoController@getPagoObra'] );
//REST de Planos
Route::resource('planos', 'PlanosController');

Route::get('jsonRubrosMateriales', ['as' => 'jsonRubrosMateriales', 'uses' => 'AjaxController@jsonRubrosMateriales']);
// Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
//generar pdf
Route::get('generate-pdf/{data}','PdfController@generatePDF');