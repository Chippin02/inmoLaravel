<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    public function users() {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    public function role_user() {
        return $this
            ->hasMany('App\Role_user')
            ->withTimestamps();
    }
}
