<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model {
    protected $fillable=['publisher_id','property_id','pubTitle','type', 'price'];

    public function user(){
        return $this->belongsTo('App\User', 'publisher_id');
    }

    public function property(){
        return $this->belongsTo('App\Property', 'property_id');
    }

    public function publication_types(){
        return $this->belongsTo('App\Publication_Types', 'id');
    }
}
