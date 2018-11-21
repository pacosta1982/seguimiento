<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $fillable = ['id','name', 'number_of_households'];


    public static function getStatus($id) {
        $status = DB::table('project_status')->where('project_id', $id)->orderBy('id', 'desc')->get();
        $status_name = DB::table('project_states')->where('id', $status[0]->state_id)->get();
	    return $status_name[0]->name;
    }
    
}
