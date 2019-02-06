<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Informe;
use App\ImageGallery;
use App\Models\ProjectRubro;

class ViviendaController extends Controller
{

    public function index($id)
    {
        
        $project = Project::find($id);
        $title="Lista de Informes de Obra del Proyecto ".$project->name;
        $images = ImageGallery::get();
        $informe = Informe::where('project_id', $id)->get();
        $rubros = ProjectRubro::join('items', 'proyecto_rubro.item_id', '=', 'items.id')
        ->where('project_id', $id)
        ->orderby('category_id')
        ->get();

        //var_dump($rubros);

        return view('projects.informes.secciones.vivienda.index',compact('project','title','informe','images','rubros'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //$count = Client::count();
            //foreach( $request->id as $key=>$val){
            /*$payment = Payment::create(['amount' => $request->amount[$key],
                                        'client_id'  => $val,
                                        ]);*/
                                        //var_dump($request->id);
        //}
        //$validated="";
        foreach ($request as $key => $value) {
            //\Log::debug($key);
            //var_dump($request);
            $validated = $key;
        }
        //var_dump($request);
        //$validated = $request;
        return $validated;
        //return redirect()->action('PaymentController@index');
        //return redirect()->back()->withErrors($validator)->withInput();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
