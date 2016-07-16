@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Osoby</div>
				<div class="panel-body">
                                    <a href="{{ url('kontakty/osoby/lista')}}"><h2>Lista</h2></a>
                                    <a href="{{ url('kontakty/osoby/dodaj')}}"><h2>Dodaj nową osobę</h2></a>
                                    <a href="{{ url('kontakty/osoby/ostatnie')}}"><h2>Ostatnio stworzone</h2></a>
                                    <a href="{{ url('kontakty/ulubione/osoby')}}"><h2>Ulubione</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
