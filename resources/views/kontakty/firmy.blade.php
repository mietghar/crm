@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Firmy</div>
				<div class="panel-body">
                                    <a href="{{ url('kontakty/firmy/lista')}}"><h2>Lista</h2></a>
                                    <a href="{{ url('kontakty/firmy/dodaj')}}"><h2>Dodaj nową firmę</h2></a>
                                    <a href="{{ url('kontakty/firmy/ostatnie')}}"><h2>Ostatnio stworzone</h2></a>
                                    <a href="{{ url('kontakty/ulubione/firmy')}}"><h2>Ulubione</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
