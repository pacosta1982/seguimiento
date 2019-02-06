<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ApiProjectController extends Controller
{
    public function getprojects(Request $request)
    {
        //$projects = Project::all();
        return response()->json(Project::all(), 200);

    }
}
