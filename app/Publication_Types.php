<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication_Types extends Model {
    protected $fillable=['name'];

    public function publication(){
        return $this->hasMany('App\Publication');
    }
}