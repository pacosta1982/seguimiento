<?php

namespace App\Imports;

use App\Estates;
use Maatwebsite\Excel\Concerns\ToModel;

class EstateImport implements ToModel
{
    public function model(array $row)
    {
        return new Estates([
        
            'project_id' => $row[0],
            'finca' => $row[4],
            'cta_cte_ctral' => $row[6],
            'utm' => $row[1],
            'utm_x' => $row[3],
            'utm_y' => $row[2],
            'padron' => $row[5]
        ]);
    }
}