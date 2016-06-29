@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Cennik produktów</div>
				<div class="panel-body">
                                    <a href="{{ url('cennik/przeglad')}}"><h2>Przegląd</h2></a>
                                    <a href="{{ url('cennik/dodaj')}}"><h2>Dodaj</h2></a>
                                    <a href="{{ url('cennik/edytuj')}}"><h2>Edytuj</h2></a>
                                    <a href="{{ url('cennik/usun')}}"><h2>Usuń</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
