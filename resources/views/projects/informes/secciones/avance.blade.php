<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
        <th>Informe</th>
        <th>Fecha</th> 
        <th class="dt-center">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach($informecasa as $inf)  
        <tr>
        <td>Informe de Obra N° {!! $inf->num_vista !!}</td>
        
        <td>{!! $inf->fecha_visita !!}</td>
        <td class="dt-center">
            <a href="" class="announce"> 
                <button class="btn btn-primary" type="button">Fiscalizar</button>
            </a>
        </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
        <th>Informe</th>
        
        <th>Fecha</th> 
        <th class="dt-center">Acciones</th>
        </tr>
    </tfoot>
</table>