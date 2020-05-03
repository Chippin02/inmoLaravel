<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model {
    protected $fillable=['user_id','description','type','m2','photo','name','city','address'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function property_types(){
        return $this->belongsTo('App\Property_types', 'type');
    }

    public function publication(){
        return $this->hasMany('App\Publication');
    }
}
