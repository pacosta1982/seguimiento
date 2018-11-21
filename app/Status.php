<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'project_status';
    
    protected $fillable = ['project_id', 'state_id'];
}
