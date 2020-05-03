<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model {

    protected $fillable = ['role_id'];

    protected $table = 'role_user';

    public function users() {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    public function roles() {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
}
