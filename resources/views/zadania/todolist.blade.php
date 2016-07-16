@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Moje zadania</div>
				<div class="panel-body">
                                    <a href="{{ url('zadania/todolist/przeglad')}}"><h2>Przeglądaj zadania</h2></a>
                                    <a href="{{ url('zadania/todolist/dodaj')}}"><h2>Dodaj nowe zadanie</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
