<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $fillable=['interested_id','publication_id'];

    public function user(){
        return $this->belongsTo('App\User', 'interested_id');
    }

    public function publication(){
        return $this->belongsTo('App\Publication', 'publication_id');
    }
}
