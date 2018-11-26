<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class State extends Model
{
  use SoftDeletes, Sortable;

  protected $fillable = [
      'name','status'
  ];

  public $sortable = ['id', 'name'];

  protected $dates = ['deleted_at'];

  /*public function profile() {
    return $this->hasMany('App\Profile','state_id','id');
  }*/

   public function cities(){
      return $this->hasMany(City::class);

   }

   public static function getStateName($id) {
       $status = DB::table('states')
       ->where('id', $id)
       ->get();
       return $status[0]->name;
   }
}
