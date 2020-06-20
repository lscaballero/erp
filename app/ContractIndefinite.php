<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractIndefinite extends Model
{
    protected $table = 'contract_indefinite';

    //Many to one
    public function contracts(){
        return $this->belongsTo('App\Contract', 'contract_id');
    }

    //one to many
    public function user(){
        return $this->hasMany('App\User', 'user_id');
    }
}
