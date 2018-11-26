@extends('adminlte::page')


@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{!! $title !!}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form method="POST" action="{{isset($project->id)?action('ProjectController@update',['id' => $project['id']]):action('ProjectController@store')}}" >
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="box-body">
          <div class="row">
              <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" onfocus="bPreguntar = true;" placeholder="Nombre del Proyecto" class="form-control required" value="{{old('name',isset($project['name'])?$project['name']:'')}}"  >
                    </div>
                    <div class="form-group">
                        <label>Departamento</label>
                        <select class="form-control required" name="state_id">
                            <option value="">Selecciona un departamento</option>
                            @foreach($statesInit as $state)
                                <option value="{{$state->id}}" {{ old('state_id',isset($project['state_id'])?$project['state_id']:'') == $state->id ? "selected":"" }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distrito</label>
                        <select class="form-control required" name="city_id">
                            <option value="">Selecciona un Distrito</option>
                            @if(isset($cities))
                                @foreach($cities as $key=>$city)
                                    <option value="{{$key}}" {{ old('city_id',isset($project['city_id'])?$project['city_id']:'') == $key ? "selected":"" }}>{{ $city }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Localidad / Barrio</label>
                        <select class="form-control required" name="neighborhood_id">
                            <option value="">Selecciona una localidad</option>
                            @if(isset($neighborhoods))
                                @foreach($neighborhoods as $key=>$neighborhood)
                                    <option value="{{$key}}" {{ old('neighborhood_id',isset($project['neighborhood_id'])?$project['neighborhood_id']:'') == $key ? "selected":"" }}>{{ $neighborhood }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad de Viviendas</label>
                        <input type="hidden" name="number_of_households" id="number_of_households" value="{{old('number_of_households',isset($project['number_of_households'])?$project['number_of_households']:'')}} "placeholder="Cantidad de viviendas" class="form-control total">
                        <input type="text" disabled name="number_of_households2" id="number_of_households2" value="{{old('number_of_households',isset($project['number_of_households'])?$project['number_of_households']:'')}} "placeholder="Cantidad de viviendas" class="form-control total">
                    </div>    
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" rows="1" class="form-control">{{old('description',isset($project['description'])?$project['description']:'')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Objetivos</label>
                        <textarea name="goals" rows="1" class="form-control">{{old('goals',isset($project['goals'])?$project['goals']:'')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Resultados</label>
                        <textarea name="objectives" rows="1" class="form-control">{{old('objectives',isset($project['objectives'])?$project['objectives']:'')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Valor Ofertado del Terreno Gs.</label>
                        <input type="text" name="value" maxlength="30" value="{{old('value',isset($project['value'])?$project['value']:'')}}" id="value" placeholder="Valor Ofertado del Terreno Gs." class="form-control">
                    </div>
              </div>
          </div>
          <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nivel 1</label>
                        <input type="text" name="level1" id="level1" value="{{old('level1',isset($level1[0]->number_of_beneficiaries)?$level1[0]->number_of_beneficiaries:'0')}}" placeholder="Ingrese Cantidad" class="form-control qty1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nivel 2</label>
                        <input type="text" name="level2" id="level2" value="{{old('level2',isset($level2[0]->number_of_beneficiaries)?$level2[0]->number_of_beneficiaries:'0')}}" placeholder="Ingrese Cantidad" class="form-control qty1">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nivel 3</label>
                        <input type="text" name="level3" id="level3" value="{{old('level3',isset($level3[0]->number_of_beneficiaries)?$level3[0]->number_of_beneficiaries:'0')}}" placeholder="Ingrese Cantidad" class="form-control qty1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Nivel 4</label>
                        <input type="text" name="level4" id="level4" value="{{old('level4',isset($level4[0]->number_of_beneficiaries)?$level4[0]->number_of_beneficiaries:'0')}}" placeholder="Ingrese Cantidad" class="form-control qty1">
                    </div>
                </div>
            </div>
            
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">Guardar</button>
      </div>
    </form>
  </div>
    
@endsection

@section('js')
<!--Ajax Validattion-->
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery.numeric.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>

<script type="text/javascript">

$("#dimensions").numeric({ decimalPlaces: 2 });
$("#value").numeric({ decimalPlaces: 2 });
$("#level1").numeric({ decimal: false });
$("#level2").numeric({ decimal: false });
$("#level3").numeric({ decimal: false });
$("#level4").numeric({ decimal: false });
$("#number_of_households").numeric();
$("#number_of_beneficiaries").numeric();

//$("#cta_cte_ctral").numeric();
$("#finca").numeric();
$(document).ready(function() {
            $('select[name="state_id"]').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '{{URL::to('/projects')}}/ajax/'+stateID+"/cities",
                        type: "GET",
                        dataType: "json",
                        success:function(data) {

                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append('<option value="">Selecciona un Distrito</option>');

                            $.each(data, function(key, value) {
                                $('select[name="city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });

                        }
                    });
                }else{
                    $('select[name="city_id"]').empty();
                }
            });
            
            $('select[name="city_id"]').on('change', function() {
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '{{URL::to('/projects')}}/ajax/'+cityID+"/neighborhood",
                        type: "GET",
                        dataType: "json",
                        success:function(data) {

                            $('select[name="neighborhood_id"]').empty();
                            $('select[name="neighborhood_id"]').append('<option value="">Selecciona una localidad</option>');

                            $.each(data, function(key, value) {
                                $('select[name="neighborhood_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });

                        }
                    });
                }else{
                    $('select[name="neighborhood_id"]').empty();
                }
            });

            $(document).on("change", ".qty1", function() {
                var sum = 0;
                $(".qty1").each(function(){
                    sum += +$(this).val();
                });
                //$(".total").prop('disabled', true);
                $(".total").val(sum);
            });

        $("#dimensions").numeric({ decimalPlaces: 2 });
        $("#value").numeric({ decimalPlaces: 2 });
        $("#number_of_households").numeric();
        $("#number_of_beneficiaries").numeric();



    });
</script>
    
@endsection

