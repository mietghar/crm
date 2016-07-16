<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>System CRM mietech.pl</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">System CRM mietech.pl</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Główna</a></li>
                                        @if (Auth::check())
<!--                                        @if (Auth::user()->role_id == 1)-->
                                            <li class="dropdown">
                                                <a href="{{ url('/cennik') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Handel<span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{url('cennik')}}">Handel</a></li>
                                                    <li><a href="{{url('cennik/oferty')}}">Oferty</a></li>
                                                    <li><a href="{{url('cennik/przeglad')}}">Produkty</a></li>
                                                    <li><a href="{{url('cennik/dodaj')}}">Dodaj produkt</a></li>
                                                    <li><a href="{{url('cennik/edytuj')}}">Edytuj produkt</a></li>
                                                    <li><a href="{{url('cennik/usun')}}">Usuń produkt</a></li>
                                                    <li><a href="{{url('cennik/dodaj_kategorie')}}">Dodaj kategorię</a></li>
                                                    <li><a href="{{url('cennik/edytuj_kategorie')}}">Edytuj kategorię</a></li>
                                                    <li><a href="{{url('cennik/usun_kategorie')}}">Usuń kategorię</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="{{ url('/kontakty') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Kontakty<span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{url('kontakty')}}">Kontakty</a></li>
                                                    <li><a href="{{url('kontakty/firmy')}}">Firmy</a></li>
                                                    <li><a href="{{url('kontakty/osoby')}}">Osoby</a></li>
                                                    <li><a href="{{url('kontakty/ulubione')}}">Ulubione</a></li>
                                                    <li><a href="{{url('kontakty/zespol')}}">Zespół</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="{{ url('/zadania') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Zadania<span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{url('zadania')}}">Zadania</a></li>
                                                    <li><a href="{{url('zadania/spotkania')}}">Oczekujące spotkania</a></li>
                                                    <li><a href="{{url('zadania/spotkaniazakonczone')}}">Historyczne spotkania</a></li>
                                                    <li><a href="{{url('zadania/todolist')}}">Do zrobienia</a></li>
                                                    <li><a href="{{url('zadania/zespol')}}">Zadania zespołów</a></li>
                                                </ul>
                                            </li>
                                        <!--@endif-->
                                        @endif
                                        
                                
					@if (Auth::guest())
					@else
                                            @if(Auth::user()->admin==1)
                                            <li class="dropdown">
                                                <a href="{{ url('/admin') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Administracja<span class="caret"></span></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{url('administracja')}}">Administracja</a></li>
                                                    <li><a href="{{url('administracja/uzytkownicy')}}">Użytkownicy</a></li>
                                                    <li><a href="{{url('administracja/zespoly')}}">Zespoły</a></li>
                                                    <li><a href="{{url('administracja/zasoby')}}">Zasoby</a></li>
                                                    <li><a href="{{url('administracja/newsletter')}}">Newsletter</a></li>
                                                </ul>
                                            </li>
                                            @endif
					@endif
				</ul>
                                        
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Zaloguj</a></li>
						<li><a href="{{ url('/auth/register') }}">Zarejestruj się</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Wyloguj się</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script>
        $(function() {
          $( "#datepicker" ).datepicker();
        });
        </script>
</body>
</html>
