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
				<div class="panel-heading">Administracja</div>
				<div class="panel-body">
                                    <a href="{{ url('administracja/uzytkownicy')}}"><h2>Przegląd użytkowników</h2></a>
                                    <a href="{{ url('administracja/zespoly')}}"><h2>Przegląd zespołów</h2></a>
                                    <a href="{{ url('administracja/zasoby')}}"><h2>Przegląd zasobów firmy</h2></a>
                                    <a href="{{ url('administracja/newsletter')}}"><h2>Newsletter</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
