<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_types extends Model {
    protected $fillable=['name'];

    public function property(){
        return $this->hasMany('App\Property');
    }
}
