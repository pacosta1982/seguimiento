<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Ultimos Proyectos</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example" class="table" style="width:100%">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Departamento</th>
                  <th class="text-center">Etapa</th>
                </tr>
                </thead>
            <tbody>
                @foreach($projects as $project)  
              <tr>
                <td><a href="l">{!! $project->id !!}</a></td>
                <td>{!! $project->name !!}</td>
                <td></td>
                <td class="text-center">
                    <span class="label label-success">
                        {{ App\Project::getStatus($project->id)  }}
                    </span>
                </td>
              </tr>
             @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                  <th>Nombre</th>
                  <th>Departamento</th>
                  <th class="text-center">Etapa</th>
                </tr>
            </tfoot>
        </table>
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <!-- /.box-footer -->
  </div>