<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'assigned_roles'); //nombre de la tabla pivot
    // }
    public function role(){
        return $this->belongsTo(Role::Class);
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
    public function hasPermission(array $permisos){

        $permissionUser = explode(',' , $this->role->role_permission);
        // $a="";

        foreach ($permisos as $permiso) {
            $permiso = $this->getPermissionsId($permiso);
            if ($permiso) {
                $permission = array_search($permiso, $permissionUser);
                // dd($permission);
                if ($permission!==false) {
                      return true;
                }  
            }
            // $a.=$permiso;
        }
        return false;
    }

        /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}








