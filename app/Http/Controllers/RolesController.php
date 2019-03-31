<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware(['auth', 'roles:role']); 
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        // return view('roles.create', compact('roles', 'permissions'));
        // $permissions = $this->nested($permissions);
        // dd($permissions);
        
        return view('roles.create', compact('roles', 'permissions'));
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = Permission::all();
        $permisos = $request->input('per');
        // dd($permisos);
        $role = new Role;
        $role->role = $request->input('rol');
        $role->role_name = $request->input('nombre_rol');
        $role->role_description = $request->input('desc');
        $permissions_request = $request->input('per');
        $role_permission = "";
        $padres = array();
        $sw=1;
        foreach ($permissions_request as $permission) {
            $padres[]=$this->nested($permissions, $permission);
            $permission = $this->getPermissionsId($permission);
            $role_permission.= $permission.',';
        }
        $padres = array_unique($padres);
        $c=1;
        foreach ($padres as $padre) {
            if (count($padres)==$c) {
                $role_permission.= $padre;
             
            }else{

                $role_permission.= $padre.',';
            }
            $c++;
        }
        $role->role_permission = $role_permission;

        $role->save();
        return redirect()->route('roles.create');
    }
    public function getPermissionsId($permiso)
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($permission->permission_name == $permiso) {
                return $permission->id;
            }
        }
        return false;
    }
    public function nested($rows = array(), $description)
    {
        // $padres = array();
        $padres="";
        if (!empty($rows)) {
            foreach ($rows as $row) {
                if ($row['permission_name'] == $description && $row['permission_level']!='1') {
                    if ($row['permission_level']==2) {
                        $padres.= $row['id_padre'];
                    }else{
                        $padres.= $row['id_padre'].',';  
                    }
                    $desc = "";
                    foreach ($rows as $r) {
        
                        if ($r['id'] == $row['id_padre'] ) {
                            $desc = $r['permission_name'];
                         }
                    }
                    $padres.=$this->nested($rows, $desc); 
                }
            }
        }
        return $padres;
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
        $role = Role::findOrFail($id);
        $rolePermissions = (explode(',', $role->role_permission));
        $permissionName=array();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            foreach ($rolePermissions as $rolePermission) {
                $permission= $permission->findOrFail($rolePermission);
                $permissionName[] = $permission->permission_name;
            }
        }
        $per= array_unique($permissionName);
        return view('roles.edit', compact('per', 'role'));
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissions_request = $request->input('per');
        $role_permission="";
        foreach ($permissions_request as $permission) {
            $padres[]=$this->nested($permissions, $permission);
            $permission = $this->getPermissionsId($permission);
            $role_permission.= $permission.',';
        }
        $padres = array_unique($padres);
        // dd($padres);
        $c=1;
        foreach ($padres as $padre) {
            if (count($padres)==$c) {
                $role_permission.= $padre;
             
            }else{

                $role_permission.= $padre.',';
            }
            $c++;
        }
        // dd($role_permission);
        $role->update([
            $role->role = $request->input('rol'),
            $role->role_name = $request->input('nombre_rol'),
            $role->role_description = $request->input('desc'),
            $role->role_permission = $role_permission
        ]);
        return redirect()->route('roles.create');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
