<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Project;
use App\Imports\ProjectImport;
use App\Imports\EstateImport;
use App\Imports\StatusImport;


class ImportController extends Controller
{
    
    public function import()
    {
        Excel::import(new ProjectImport, 'book.xlsx');
    }

    public function importestates()
    {
        Excel::import(new EstateImport, 'book_proyectos_estates.xlsx');
    }

    public function importstatus()
    {
        Excel::import(new StatusImport, 'book_proyectos_estates.xlsx');
    }
}
