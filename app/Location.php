<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'city_id',
    ];

    protected $dates = ['deleted_at'];

    /* public function state() {
         return $this->hasOne('App\State','id','state_id');
     }*/

    public function city(){
        return $this->belongsTo( City::class);
    }


}
