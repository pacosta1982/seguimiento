<!DOCTYPE html>
<html lang="en">
@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<body class="login-page">
<div class="login-container">
    <div class="login-branding">
        <a href="{{url('home')}}"><img src="{{asset('images/senavitat_logo_transparente_blanco.png')}}" alt="SIGPH" title="SIGPH"></a>
    </div>
    <div>
        <h2 class="center-login">Sistema Integrado de Gestión de Proyectos Habitacionales</h2>
    </div>
    <div class="login-content">
        <h2>@yield('htmlheader_title', 'Your title here')</h2>
        @yield('content')
    </div>
</div>
<!-- Scripts -->
@section('scripts')
    @include('layouts.partials.scripts')
@show
<!-- /scripts -->
</body>
</html>