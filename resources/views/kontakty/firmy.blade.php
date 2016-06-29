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
                                    <a href=""><h2>Lista</h2></a>
                                    <a href=""><h2>Ostatnio stworzone</h2></a>
                                    <a href=""><h2>Wg kraju</h2></a>
                                    <a href=""><h2>Wg branży</h2></a>
                                    <a href=""><h2>Wg zespołu</h2></a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
