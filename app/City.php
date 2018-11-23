<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class City extends Model
{

    use SoftDeletes, Sortable;

    protected $fillable = [
        'name', 'state_id',
    ];

    public $sortable = ['id', 'name'];

    protected $dates = ['deleted_at'];

   /* public function state() {
        return $this->hasOne('App\State','id','state_id');
    }*/

   public function state(){
       return $this->belongsTo(State::class);
   }

    public function locations(){
        return $this->hasMany(Location::class);

    }

    public static function getCityName($id) {
        $status = DB::table('cities')
        ->where('id', $id)
        ->get();
        return $status[0]->name;
    }

}
