<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{ 
    function __construct()
    {
        //el primer middleware es para que solo se pueda ingresar a la vista de users si esta autenticado
        // el segundo es para que solo el rol admin tenga acceso a Administrar Usuario
        $this->middleware(['auth', 'roles:usr']); 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.create', compact('users', 'roles'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //      $this->validate($request, [
    //         // 'email' => 'required|string|email',
    //         'password' => 'min:6',
    // ]);

        $user = new User;
        $user->name = $request->input('nombre');
        $user->username = $request->input('usuario');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('idrole');
        // $user->setRememberToken(Str::random(60));
        $user->save();

       return redirect()->route('users.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $user = User::findOrFail($id);
        $roles = Role::all();
        
        return view('users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        $user->update([
            $user->name = $request->input('nombre'),
            $user->username = $request->input('usuario'),
            $user->email = $request->input('email'),
            $user->role_id = $request->input('idrole')

        ]);
       
        return redirect()->route('users.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            $user->estado = 0
        ]);

        return redirect()->route('users.create');
    }
}
