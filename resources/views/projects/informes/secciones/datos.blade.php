<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Proyecto: {!! $project->name !!}</h3>
    </div>
    <div class="box-body">
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <address>
                <strong>
                Nombre Proyecto: {!! $project->name !!}<br>
                Postulantes Elegibles: {!! $project->number_of_households !!}<br>
                Beneficiarios Elegibles: {{isset($beneficiarios)?$beneficiarios->count():'0'}}<br>
                Departamento: {!! $project->state_id?$project->state->name:"" !!}<br>
                Municipio: {!! $project->city_id?$project->city->name:"" !!}<br>
                Tipo: <br> 
                SAT: <br>
                <br>
                Etapa del Proyecto<br>
                {{ App\Project::getStatus($project->id)}}
                </strong>
                </address>
            </div>
            <div class="col-sm-6 invoice-col">
                <address>
                <strong>
                Nombre Proyecto: {!! $project->name !!}<br>
                Postulantes Elegibles: {!! $project->number_of_households !!}<br>
                Beneficiarios Elegibles: {{isset($beneficiarios)?$beneficiarios->count():'0'}}<br>
                Departamento: {!! $project->state_id?$project->state->name:"" !!}<br>
                Municipio: {!! $project->city_id?$project->city->name:"" !!}<br>
                Tipo: <br> 
                SAT: <br>
                <br>
                Etapa del Proyecto<br>
                {{ App\Project::getStatus($project->id)}}
                </strong>
                </address>
            </div>
        </div>
    </div>
</div>

<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Vigencia de Pólizas</h3>
    </div>
    <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
1
                </div>
                <div class="col-sm-4">
2
                </div>
                <div class="col-sm-4">
3
                </div>
            </div>
        </div>
</div>

<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Obligaciones del Sat</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-4">
1
                </div>
                <div class="col-sm-4">
2
                </div>
                <div class="col-sm-4">
3
                </div>
            </div>
        </div>
    </div>