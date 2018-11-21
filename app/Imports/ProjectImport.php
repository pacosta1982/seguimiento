<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\ToModel;

class ProjectImport implements ToModel
{
    public function model(array $row)
    {
        return new Project([
            'id' => $row[0],
            'name' => $row[1],
            'number_of_households' => $row[2]
        ]);
    }
}