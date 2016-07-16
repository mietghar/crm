@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Spotkania</div>
				<div class="panel-body">
                                    <a href="{{ url('zadania/spotkania/przegladaj')}}"><h2>Przeglądaj</h2></a>
                                    <a href="{{ url('zadania/spotkania/dodaj')}}"><h2>Dodaj nowe spotkanie</h2></a>
                                    <a href="{{url('zadania/spotkania/edytuj')}}"><h2>Edytuj dane spotkania</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
