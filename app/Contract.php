<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    //One to Many
    public function contracts_indefinites(){
        return $this->hasMany('App\ContractIndefinite');
    }

    //One to Many
    public function contracts_services(){
        return $this->hasMany('App\ContractIndefinite');
    }

    //One to Many
    // public function user(){
    //     return $this->hasMany('App\User', 'user_id');
    // }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
