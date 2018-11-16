<!DOCTYPE html>
<html lang="es">
@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<body>
<!-- Page container -->
<div class="page-container">
    <!-- Page sidebar -->
    @include('layouts.partials.sidebar')
    <!-- /page sidebar -->
    <!-- Main container -->
    <div class="main-container">
        <!-- Main header -->
        @include('layouts.partials.mainheader')
        <!-- /main header -->
        <!-- Main content -->
        <div class="main-content">
            <div class="page-heading clearfix">
                <h1 class="page-title">@yield('htmlheader_title', 'Your title here')@yield('addbutton')</h1>
                <!-- Breadcrumb -->
                @yield('breadcrumb')
                <!-- /breadcrumb -->
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
                </div>
            @endif
            @yield('main-content')
            <!-- Footer -->
            <footer class="footer-main">
                &copy; 2017 <strong>SIGPH</strong>
                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#newIssue">Nuevo Ticket</button>
                <div class="modal fade" id="newIssue" tabindex="-1" role="dialog" aria-labelledby="newIssue" aria-hidden="true">
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title"><i class="fa fa-pencil"></i> Crear Nuevo Ticket</h4>
									</div>
									<form action="" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
										<div class="modal-body">
											<div class="form-group">
												<input name="subject" type="text" class="form-control" placeholder="Asunto">
											</div>
											<div class="form-group">
												<input name="department" type="text" class="form-control" placeholder="Dirección">
											</div>
											<div class="form-group">
												<textarea name="message" class="form-control" placeholder="Detalle la incidencia" style="height: 120px;"></textarea>
											</div>
											<div class="form-group">
												<input type="file" name="attachment">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Descartar</button>
											<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Crear</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
            </footer>
            <!-- /footer -->
        </div>
        <!-- /main content -->


    </div>
    <!-- /main container -->
</div>
<!-- /page container -->
<!-- Scripts -->
@include('layouts.partials.scripts')
@yield('scripts')
<!-- /scripts -->
@yield('after_styles')
@yield('after_scripts')

@yield('after_scripts_senavitat')
</body>
</html>
