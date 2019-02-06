<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
          <th>Rubro</th>
          <th class="text-center">Un.</th>
          <th class="text-center">Cantidad</th>
          <th class="text-center">P. Unitario</th>
          <th class="text-center">P. Total</th>
          <th class="text-center">Avance</th>
        </tr>
        </thead>
    <tbody>
        @php
            $aux=0;
        @endphp
        <form method="post" action="{{ url('save_vivienda') }}">
        {!! csrf_field() !!}
        @foreach($rubros as $ru)
            @if ($ru->category_id !== $aux)
            
                <tr class="header">
                    <td class="bg-light-blue-active color-palette">{!! $ru->category_id?$ru->state->categoria->name:"" !!}</td>
                    <td class="text-center bg-light-blue-active color-palette"></td>
                    <td class="text-center bg-light-blue-active color-palette"></td>
                    <td class="text-center bg-light-blue-active color-palette"></td>
                    <td class="text-center bg-light-blue-active color-palette"></td>
                    <td class="text-center bg-light-blue-active color-palette"></td> 
                </tr>
                @php
                    $aux=$ru->category_id;
                @endphp
            @endif
              <tr >
                <td>{!! $ru->item_id?$ru->state->name:"" !!}</td>
                <td class="text-center">{!! $ru->unidad_id?$ru->unidad->name:"" !!}</td>
                <td class="text-center">{!! $ru->quantity !!}</td>
                <td class="text-center">{!! number_format($ru->unit_price,0,'.','.') !!}</td>
                <td class="text-center">{!! number_format(($ru->unit_price * $ru->quantity),0,'.','.') !!}</td>
                <td class="text-center">
                        <select id="wgtmsr" class="js-example-basic-single" name="{!! $ru->item_id !!}">
                                <option value="0">0% </option>
                                <option value="10">10% </option>
                                <option value="20">20% </option>
                                <option value="30">30% </option>
                                <option value="40">40% </option>
                                <option value="50">50% </option>
                                <option value="60">60% </option>
                                <option value="70">70% </option>
                                <option value="80">80% </option>
                                <option value="90">90% </option>
                                <option value="100">100% </option>
                              </select></td>
              </tr>          
     @endforeach
     
    </tbody>
    <tfoot>
         
    </tfoot>
</table>
<div class="form-group row">
    <div class="offset-sm-3 col-md-12">
        <button type="submit" class="btn btn-success pull-right">Guardar Datos</button>
    </div>
</div>
</form> 
@section('css')
<style>
#wgtmsr{
 width:100px;   
}

#wgtmsr option{
 width:80px;   
}

</style>
@endsection   

@section('js')

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        placeholder: "Avance",
        
    });
});
</script>
    
@endsection
    