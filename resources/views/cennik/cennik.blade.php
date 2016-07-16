@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if (Session::has('danger'))
                                    <div class="alet alert-danger">{{ Session::get('danger') }}</div>
                                @endif
				<div class="panel-heading">Moduł handlowy</div>
				<div class="panel-body">
                                    <a href="{{ url('cennik/oferty')}}"><h2>Przegląd ofert</h2></a>
                                    <a href="{{ url('cennik/przeglad')}}"><h2>Przegląd produktów</h2></a>
                                    <a href="{{ url('cennik/dodaj')}}"><h2>Dodaj produkt</h2></a>
                                    <a href="{{ url('cennik/edytuj')}}"><h2>Edytuj produkt</h2></a>
                                    <a href="{{ url('cennik/usun')}}"><h2>Usuń produkt</h2></a>
                                    <a href="{{ url('cennik/dodaj_kategorie')}}"><h2>Dodaj kategorię</h2></a>
                                    <a href="{{ url('cennik/edytuj_kategorie')}}"><h2>Edytuj kategorię</h2></a>
                                    <a href="{{ url('cennik/usun_kategorie')}}"><h2>Usuń kategorię</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
