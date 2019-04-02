<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
		
	}

// $this->middleware(['auth', 'roles:wor,sec,emp,sto,set']);
    public function home()
    {
    	return view('home');
    }

    function loadAdministrationView()
    {
    	return view('AdminUsers');
    }
    function loadMantenedores()
    {
        return view('subMantenedores');
    }
    function loadStore(){
        return view('almacen.almacen');
    }
   
}