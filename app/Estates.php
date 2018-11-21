<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estates extends Model
{
    protected $table = 'estates';
    
    protected $fillable = ['project_id', 'finca', 'cta_cte_ctral', 'utm', 'utm_x', 'utm_y', 'padron'];
}
