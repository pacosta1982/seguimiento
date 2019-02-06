<table id="example" class="table" style="width:100%">
        <thead>
            <tr>
              <th>Nombre</th>
              <th>Archivo</th>
              <th>Fecha</th>
              <th>Observación</th>
              <th class="text-center"></th>
              <th class="text-center">Acciones</th>
            </tr>
            </thead>
        <tbody>
            @foreach($files as $fu)  
          <tr>
            <td>{!! $fu->title !!}</td>
            <td>{!! $fu->file_path !!}</td>
            <?php $date=date_create($fu->date);  ?>
            <td><?php echo date_format($date, 'd/m/y'); ?></td>
            <td>{!! $fu->overview !!}</td>
            <td></td>
            <td class="text-center">
                <a href="{{asset('uploads/')}}/{{$fu->project_id."/".$fu->file_path}}" target="_blank" class="announce"> 
                    <button class="btn btn-success" type="button"> Ver </button>
                </a>
                <a href="{!! action('FileController@generate_pdf', ['id'=>$fu->project_id, 'file'=> $fu->file_path]) !!}" target="_blank" class="announce"> 
                    <button class="btn btn-danger" type="button"> Ver Marca </button>
                </a>
                 <!--   <button onclick="eliminarfile('files_urbanizacion', '{{$fu->id}}', 'repositorio/{{$fu->project_id."/adjuntos/2/".$fu->file}}','3')" class="btn btn-danger" type="button"> Eliminar</button> -->
            </td>
          </tr>
         @endforeach
        </tbody>
        <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Archivo</th>
              <th>Fecha</th>
              <th>Observación</th>
              <th class="text-center"></th>
              <th class="text-center">Acciones</th>
            </tr>
        </tfoot>
    </table>