@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                            
                                @if (Session::has('success'))
                                    <div class="alet alert-success">{{ Session::get('success') }}</div>
                                @endif
				<div class="panel-heading">Kontakty</div>
				<div class="panel-body">
                                    <a href="{{ url('kontakty/firmy')}}"><h2>Firmy</h2></a>
                                    <a href="{{ url('kontakty/osoby')}}"><h2>Osoby</h2></a>
                                    <a href=""><h2>Ulubione</h2></a>
                                    <a href=""><h2>Zespół</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
