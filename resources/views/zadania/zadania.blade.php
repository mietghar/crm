@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Zadania</div>
				<div class="panel-body">
                                    <a href="{{ url('zadania/spotkania')}}"><h2>Oczekujące spotkania</h2></a>
                                    <a href="{{ url('zadania/spotkaniazakonczone')}}"><h2>Historyczne spotkania</h2></a>
                                    <a href="{{ url('zadania/todolist')}}"><h2>Do zrobienia</h2></a>
                                    <a href="{{url('zadania/zespol')}}"><h2>Zadania zespołów</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
