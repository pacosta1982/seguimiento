@extends('adminlte::page')

@section('title', 'Carga de Documentos')

@section('content_header')
    <h1>Documentos Obra:  {!! $project->name !!}</h1>
@stop

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Resumen de Documentos Adjuntados</h3>
      <div class="box-tools pull-right">
            
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <label>Documentos Requeridos:</label>
        <p>
          - Certificado de Condición de Dominio</br>
          - Título de la Propiedad</br>
          - Plano Georreferenciado Sellado por el SNC</br>
          - Plano de loteamiento
        </p>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <a role="button" class="btn btn-info announce" style="margin-top: 5px;" href=""
                data-toggle="modal"
                data-id="{!! $project->id !!}"
                data-title="Documentos Adjuntos del Proyecto" onclick="callForm()">
                <i class="fa fa-paperclip"></i> Subir Documento
        </a>
    </div><!-- box-footer -->
  </div><!-- /.box -->

  <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Documentos Adjuntos del Proyeto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
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
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
      </div>

    <div class="example-modal" >
            <div class="modal modal-success" id="formadjunto">
              <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Documentos del Proyecto</h4>
                    </div>
                    <div class="modal-body">
                       <!-- inicio form -->
                       <form method="post" action="{{url('file/upload')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="project_id" value="{{ $project->id}}">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="col-sm-12 control-label">Nombre del archivo</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <input type="text" name="name" id="name" placeholder="Ingrese Nombre del Archivo" class="form-control" value=""  >
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="col-sm-12 control-label">Archivo</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="file" name="file">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="col-sm-12 control-label">Observación</label>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <textarea class="form-control" id="overview" name="overview" rows="3" placeholder="Observaciones ..."></textarea>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                      <button type="submit" class="btn btn-outline">Guardar</button>
                    </div>
                    <!-- fin form -->
                </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
              </div>
            </div>


@endsection
@section('js')
<script src="{{asset('js/popup.js')}}"></script>
<script src="{{asset('js/jquery.numeric.js')}}"></script>
<script type="text/javascript">
    function callForm(){
      $("#formadjunto").modal();
    }

    
    $(document).ready(function(){
     $('#element_to_pop_up').hide();

            $("#text1").numeric();
            $("#text2").numeric();
            $("#text3").numeric();
             $("#text6").numeric();
            $("#text7").numeric();
            $("#text8").numeric();


    });

    function actualizar(){
      location.reload();
   }

    


    function recargartodo(){
        releadlistfiles('5');
    }

    function verArchivo(dir){
        url=dir;
    $('#element_to_pop_up').bPopup({
           content:'iframe',
            contentContainer:'.mostrarmodal',
            loadUrl:url
        });
    }

    /*
     * Calculo superficie urbanistico
     */
    function total_superficie_urbanistico(){
        //alert("va a calcular");
        var uno =parseInt(document.getElementById("text1").value);
        var dos = parseInt(document.getElementById("text2").value);
        var tres = parseInt(document.getElementById("text3").value);
       // alert(uno+' dos '+dos+' tres '+tres)
        if(uno=="")uno=0;
        if(dos=="")dos=0;
        if(tres=="")tres=0;
        var cuatro = uno+dos+tres;
        if(isNaN(cuatro)){
            document.getElementById("text4").value=0;
        }
        else
        {
        document.getElementById("text4").value=cuatro;
        }
    }



    function copiar_cantidad(){
        document.getElementById("text12").value=document.getElementById("text8").value;
    }

    function total_presupuesto_vivienda(){
        //alert("va a calcular");
        var uno =parseInt(document.getElementById("text11").value);
        var dos = parseInt(document.getElementById("text8").value);
        //var tres = parseInt(document.getElementById("text3").value);
       // alert(uno+' dos '+dos+' tres '+tres)
        if(uno=="")uno=0;
        if(dos=="")dos=0;
        var cuatro = uno*dos;
        if(isNaN(cuatro)){
            document.getElementById("text13").value=0;
        }
        else
        {
        document.getElementById("text13").value=cuatro;
        }
    }

    function total_presupuesto_urbanizacion(){
        //alert("va a calcular");
        var uno =parseInt(document.getElementById("text10").value);
        var dos = parseInt(document.getElementById("text13").value);
        //var tres = parseInt(document.getElementById("text3").value);
       // alert(uno+' dos '+dos+' tres '+tres)
        if(uno=="")uno=0;
        if(dos=="")dos=0;
        var cuatro = uno+dos;
        if(isNaN(cuatro)){
            document.getElementById("text14").value=0;
        }
        else
        {
        document.getElementById("text14").value=cuatro;
        }
    }

    
</script>
@endsection
