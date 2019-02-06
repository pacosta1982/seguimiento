<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $table = 'informes_visitas';
    
    protected $fillable = ['project_id', 'num_vista','fecha_visita'];
}
