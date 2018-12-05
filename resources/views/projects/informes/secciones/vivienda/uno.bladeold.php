@php
$aux=0;
@endphp

@foreach($rubros as $ru)
@if ($ru->category_id !== $aux)

    
    
    @php
        $aux=$ru->category_id;
    @endphp
@endif
 

@endforeach