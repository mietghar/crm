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
				<div class="panel-heading">Ulubione</div>
				<div class="panel-body">
                                    <a href="{{ url('kontakty/ulubione/firmy')}}"><h2>Firmy</h2></a>
                                    <a href="{{ url('kontakty/ulubione/osoby')}}"><h2>Osoby</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
