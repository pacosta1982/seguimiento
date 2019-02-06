{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Calendario de Visitas</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agendar Visita</h3>
            </div>
            
                <form action="{{ route('tasks.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Visita:</label>
                                <input type="text" name="name" class="form-control"  placeholder="Ingrese Visita">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción:</label>
                                <input type="textarea" class="form-control" name="description" placeholder="Ingrese Descripción (Opcional)">
                            </div>
                            <div class="form-group">
                                <label>Inspector</label>
                                <select class="form-control required" name="user_id" id="user_id">
                                    <option value="" >Seleccione una opcion</option>
                                    @foreach($tecnico as $us)
        
                                    <option value="{{$us->id}}"
                                    >{{$us->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="task_date">Fecha:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="task_date" class="form-control date"  placeholder="Ingrese Fecha Visita">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="task_time">Hora:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" name="task_time" class="form-control timepicker"  placeholder="Ingrese Hora Visita">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
            
                        <div class="box-footer">
                            <button type="submit"  class="btn btn-primary">Enviar</button>
                        </div>
                </form>            
        </div>

    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <div id='calendar' class="fc fc-unthemed fc-ltr"></div>
            </div>
        </div>
    </div>
</div>    

@stop

@section('css')
<link href="{{asset('fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
<link href="{{asset('bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
@stop

@section('js')
    
    <script src="{{asset('fullcalendar/lib/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
    <script src="{{asset('fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{asset('fullcalendar/lang-all.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/locale-all.js')}}" charset="UTF-8"></script>
    <script src="{{asset('bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>

    bootstrap-timepicker

<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            locale: 'es',
            allDay: 'false',
            header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
            events : [
                @foreach($tasks as $task)
                {
                    title : '{{ $task->name }}',
                    start : '{{ $task->task_date  }}'+'T'+'{{ $task->task_time  }}',
                    //url : '{{ route('tasks.edit', $task->id) }}'
                },
                @endforeach
            ]
        })
    });

</script>
<script src="{{asset('js/bootstrap-datepicker.es.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">

    $('.date').datepicker({  
       format: 'yyyy-mm-dd',
       autoclose: 'true',
       languaje: 'es'
     });
     
     $('.timepicker').timepicker({
        showMeridian: false,
        //defaultTime: false
    })

</script> 


@stop




