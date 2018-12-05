<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\DB;
use App\Models\QuestionCategory;
use App\Models\UnidadMedida;
use App\Models\Item;
use App\Models\ProjectRubro;

class PlanRubroProyController extends Controller
{
    
    public $statesInit;

    public function __construct()
    {
        $this->middleware('auth');

        $this->statesInit = QuestionCategory::all()->sortBy("name");
        
    }

    public function index()
    {
        $title="Proyectos a Planificar";
        $projects = Project::all();
        return view('planrubro.index',compact('projects','title'));
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

        ProjectRubro::create($request->all());
        return redirect('proyrubro/'.$request->input("project_id"))->with('status', 'Se ha agregado un Nuevo Rubro!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $statesInit = $this->statesInit;
        $project = Project::find($id);
        $title="Creacion de Rubros del Proyecto ".$project->name;
        $unidades = UnidadMedida::all();
        $rubros = ProjectRubro::join('items', 'proyecto_rubro.item_id', '=', 'items.id')
        ->where('project_id', $id)
        ->orderby('category_id')
        ->get();
        return view('planrubro.show',compact('project','title','statesInit','unidades','rubros'));
    }

    public function rubros($state_id){
        $cities = Item::where('category_id', $state_id)->get()->sortBy("name")->pluck("name","id");
        return json_encode($cities);
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
