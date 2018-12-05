<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Informe;
use App\ImageGallery;
use App\Models\ProjectRubro;

class ViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $project = Project::find($id);
        $title="Lista de Informes de Obra del Proyecto ".$project->name;
        $images = ImageGallery::get();
        //$projects = Project::all();
        $informe = Informe::where('project_id', $id)->get();
        $rubros = ProjectRubro::join('items', 'proyecto_rubro.item_id', '=', 'items.id')
        ->where('project_id', $id)
        ->orderby('category_id')
        ->get();

        /*$rubros = ProjectRubro::join('items', 'proyecto_rubro.item_id', '=', 'items.id')
        ->groupBy('items.category_id')
        ->select('proyecto_rubro.*') // stop the joined table from overwriting columns with the same name
        ->with('items') 
        ->orderBy('category_id', 'asc')
        ->get();*/
        //Mapper::map(-24.3697635, -56.5912129, ['zoom' => 6, 'type' => 'ROADMAP']);
        return view('projects.informes.secciones.vivienda.index',compact('project','title','informe','images','rubros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
