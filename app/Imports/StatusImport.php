<?php

namespace App\Imports;

use App\Status;
use Maatwebsite\Excel\Concerns\ToModel;

class StatusImport implements ToModel
{
    public function model(array $row)
    {
        return new Status([
        
            'project_id' => $row[0],
            'state_id' => '3'
            
        ]);
    }
}