<form action="{{ url('image-gallery') }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Archivo</label>
                <input type="text" name="title" class="form-control" placeholder="Titulo">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Imagen</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12">
                    <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-success pull-right">Subir</button>
                    </div>
            </div>
    </div>


</form>
<label for="">Imagenes de la Vivienda X</label> 
<div class="row">
        <div class='list-group gallery'>
                @if($images->count())
                    @foreach($images as $image)
                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                        <a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $image->image }}">
                            <img class="img-responsive" alt="" src="/images/{{ $image->image }}" />
                            <div class='text-center'>
                                <small class='text-muted'>{{ $image->title }}</small>
                            </div> <!-- text-center / end -->
                        </a>
                        <form action="{{ url('image-gallery',$image->id) }}" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="visita_id" value="">
                        <input type="hidden" name="vivienda_id" value="">
                        {!! csrf_field() !!}
                        <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>
                    </div> <!-- col-6 / end -->
                    @endforeach
                @endif
            </div> <!-- list-group / end -->
        </div>
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<style>


.gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
    .close-icon{
    	border-radius: 50%;
        position: absolute;
        right: 5px;
        top: -10px;
        padding: 5px 8px;
    }
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }
</style>
    
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>
    
@endsection