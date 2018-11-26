<?php

namespace App\Http\Controllers;
use App\Project;
use App\Location;
use App\State;
use App\City;
use App\User;
use App\File;
use App\Status;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProjectFormRequest;
use App\Http\Requests\StoreFile;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public $statesInit;

    public function __construct()
    {
        $this->middleware('auth');

        $this->statesInit = State::all()->sortBy("name");
        
    }

    public function index()
    {
        $title="Lista de Proyectos";
        $projects = Project::all();
        //Mapper::map(-24.3697635, -56.5912129, ['zoom' => 6, 'type' => 'ROADMAP']);
        return view('projects.index',compact('projects','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Crear Proyecto";

        $statesInit = $this->statesInit;
        //$modalitiesInit = $this->modalitiesInit;
        //$goalsInit = $this->goalsInit;
        //$objectivesInit = $this->objectivesInit;
        //$agenciesInit = $this->agenciesInit;

        $id = Auth::user()->id;
        $currentuser = User::find($id);


        //$sat=array("id"=>$currentuser->hasSatAssigned(),"name"=>$currentuser->getSatName());

        $projecstatus = 0;


        return view('projects.form',compact('title','statesInit','modalitiesInit','goalsInit','objectivesInit','agenciesInit', 'sat','projecstatus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectCreateUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectFormRequest $request)
    {

        //var_dump("ale");
        //return view('login');
        $project = new Project;
        $project->name = $request->input("name");
        $project->state_id = $request->input("state_id");
        $project->city_id = $request->input("city_id");
        $project->neighborhood_id = $request->input("neighborhood_id");
        $project->description = $request->input("description");
        $project->number_of_households = $request->input("number_of_households");
        $project->value = $request->input("value");
        $project->number_of_beneficiaries = $request->input("number_of_beneficiaries");
        $project->goals = $request->input("goals");
        $project->objectives = $request->input("objectives");


        if($project->save()){

            $projecstatus =new Status();
            $projecstatus->state_id=3;
            $projecstatus->project_id=$project->id;
            $projecstatus->created_by=$id = Auth::user()->id;
            $projecstatus->description="Proyecto Creado";
            $projecstatus->save();
        }

        //var_dump("save");
        return redirect('projects')->with('status', 'Un nuevo proyecto fue creado!');
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

        $statesInit = $this->statesInit;
        //$modalitiesInit = $this->modalitiesInit;
        //$goalsInit = $this->goalsInit;
        //$objectivesInit = $this->objectivesInit;
        //$agenciesInit = $this->agenciesInit;

        $project = Project::whereId($id)->firstOrFail();
        $cities = $this->cities($project->state_id);
        $cities = json_decode($cities, true);

        $neighborhoods = $this->neighborhoods($project->city_id);
        $neighborhoods = json_decode($neighborhoods, true);

        //$projectgoals = ProjectGoals::where('project_id', $id)->get()->sortBy("goal_id");
        //$projectobjectives = ProjectObjectives::where('project_id', $id)->get()->sortBy("objective_id");

        //$projectcoordinates = Coordinates::where('project_id', $id)->get()->sortBy("id");

        //$projectlevels = PovertyLevels::where('project_id', $id)->get()->sortBy("level");

        /*$level1 = PovertyLevels::where('project_id', $id)
                                      ->where('level', '1')
                                      ->get();

        $level2 = PovertyLevels::where('project_id', $id)
                                      ->where('level', '2')
                                      ->get();

        $level3 = PovertyLevels::where('project_id', $id)
                                      ->where('level', '3')
                                      ->get();

        $level4 = PovertyLevels::where('project_id', $id)
                                      ->where('level', '4')
                                      ->get();*/


        //$status = ProjectStatus::where('project_id', $id)->get();
        //$projecstatus = $projecstatus->state_id;

        $projecstatus = DB::table('project_status')->where('project_id', $id)->value('state_id');

        $id = Auth::user()->id;
        $currentuser = User::find($id);

        //$sat=array("id"=>$project->sat_id,"name"=>$currentuser->getSatName($project->sat_id));

        $title="Editar Proyecto ".$project->name;
        $menu = 1;
        return view('projects.form',compact('project','menu','level1','level2','level3','level4','title', 'statesInit','modalitiesInit','goalsInit','objectivesInit','agenciesInit', 'cities', 'neighborhoods', 'projectgoals', 'projectobjectives', 'projectcoordinates', 'projectlevels', 'sat','projecstatus'));

    }

    public function files($id)
    {
        $title="Documentos Adjunto";

        //$projecstatus = 0;
        $project = Project::find($id);
        $files = File::where('project_id', $id)->get();
        //$menu=1;

        //$urbanizacion = $this->listFilesAdjuntos($project->id);
        return view('files.file',compact('title','project','files'));

    }

    public function storeFile(StoreFile $request)
    {
        $user_id = Auth::user()->id;
        
        $project = new File;
        $project->user_id = $user_id;
        $project->project_id = $request->input("project_id");
        $project->title = $request->input("name");
        $project->overview = $request->input("overview");
        $file = $request->file('file');
        $a = $file->getClientOriginalName();
        $b= $file->getClientOriginalExtension();
        $project->file_path = $a;
        //$project->file_path = $request->file('file');
        $project->save();
        $dircarpeta='/uploads/'.$request->input("project_id");
        $carpeta = public_path($dircarpeta);
        $pdfname = $file->getClientOriginalName();
        $request->file('file')->move( $carpeta, $pdfname);

        return redirect('projects/'.$request->input("project_id").'/files')->with('status', 'Se ha agregado un Archivo!');
        

    }
    
    /*public function uploadFile(Request $request)
    {
           $proyecto=$request['project_id'];
           //$subdirectorio=$request['ubicacion'];   
           //$id_ubicacion=$request['id_ubicacion'];
          
           $file = $request->file('file');
           $carpetaV="adjuntos";
          
           $imageName = $file->getClientOriginalName();
           $tipoarchivo= $file->getClientOriginalExtension();
    
           
           //$vNombre= DB::table('project_documentations')->where([['file', '=', $imageName],['project_id', '=', $proyecto],])->count();
           //if($vNombre<=0){
                if($tipoarchivo=="pdf"){
                $dircarpeta='/repositorio/'.$proyecto.'/'.$carpetaV.'/'.$subdirectorio;
                $carpeta = public_path($dircarpeta);
                $date= date("Y-m-d");
                    if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }

                DB::insert('insert into project_documentations (project_id, ubication, file_name, observation, file, date, category) values (?, ?, ?, ?, ?, ?, ?)', [$request['project_id'], $id_ubicacion, $request['file_name'], $request['observation'], $imageName, $date, $request['categoria']]);
                //indicamos que queremos guardar un nuevo archivo en el disco local
                //Storage::disk('local')->put($nombre,  \File::get($file));
                $request->file('file')->move( $carpeta, $imageName);
                //return "<div class='alert alert-success' role='alert'><p align='center'>Archivo correctamente cargado <br> Puede gestionar sus archivos en la pestaña documentos</p></div>";
                return Redirect::to(URL::previous() . "#documentos")->with('status', 'Archivo correctamente cargado');
                }
                else
                {
                    //return "<div class='alert alert-danger' role='alert'><p align='center'>Tipo de archivo invalido</p></div>";
                    return Redirect::to(URL::previous() . "#documentos")->with('status', 'Tipo de archivo invalido');
                }
           }
           else
           {
               return Redirect::to(URL::previous() . "#documentos")->with('status', 'Ya existe ese archivo');
           }
    }*/

    public function upload()
    {
    return 'x';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRequest $request, $id)
    {

        //$project = Project::find($id);
        //$project->name = $request->input("name");
        /*$project->state_id = $request->input("state_id");
        $project->city_id = $request->input("city_id");
        $project->neighborhood_id = $request->input("neighborhood_id");
        $project->description = $request->input("description");
        $project->number_of_households = $request->input("number_of_households");
        $project->value = $request->input("value");
        $project->number_of_beneficiaries = $request->input("number_of_beneficiaries");
        $project->goals = $request->input("goals");
        $project->objectives = $request->input("objectives");*/
        //$project->save();

        /*if($project->save()) {

          $level1 = PovertyLevels::where('project_id', $id)
                                        ->where('level', '1')
                                        ->first();
          $level1->number_of_beneficiaries = $request->input("level1");
          $level1->save();

          $level1 = PovertyLevels::where('project_id', $id)
                                        ->where('level', '2')
                                        ->first();
          $level1->number_of_beneficiaries = $request->input("level2");
          $level1->save();

          $level1 = PovertyLevels::where('project_id', $id)
                                        ->where('level', '3')
                                        ->first();
          $level1->number_of_beneficiaries = $request->input("level3");
          $level1->save();

          $level1 = PovertyLevels::where('project_id', $id)
                                        ->where('level', '4')
                                        ->first();
          $level1->number_of_beneficiaries = $request->input("level4");
          $level1->save();*/

            //return redirect('projects')->with('status', 'El proyecto fue actualizado!');

        //}else{

        //}

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

    public function cities($state_id){
        $cities = City::where('state_id', $state_id)->get()->sortBy("name")->pluck("name","id");
        return json_encode($cities);
    }

    public function neighborhoods($city_id){
        $neighborhoods = Location::where('city_id', $city_id)->get()->sortBy("name")->pluck("name","id");

        return json_encode($neighborhoods);
    }
}
