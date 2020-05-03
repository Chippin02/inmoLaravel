<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime',];

    public function contacts(){
        return $this->hasMany('App\Contact');
    }

    public function properties(){
        return $this->hasMany('App\Property');
    }

    public function publications(){
        return $this->hasMany('App\Publication');
    }

    public function roles() {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

    public function role_user() {
        return $this
            ->hasMany('App\Role_User')
            ->withTimestamps();
    }

    //Determina si té o no roll, en cas de no tenir retorna que no pot accedir-hi
    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Acció no autoritzada.');
    }

    //Determina si tiene cualquier roll
    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    //
    public function hasRole($role) {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function getRoleName($id) {
        $role = $this->role_user()->where('user_id', $id)->first();
        return $this->roles()->where('id', $role->role_id);
    }
}
