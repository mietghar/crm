@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">CRM mietech.pl</div>

				<div class="panel-body">
					Witaj w pracy {{ Auth::user()->name }}!
				</div>
                                <div class="panel-body">
					Dziś jest {{ $ldate = date('d-m-Y') }} a przed tobą wiele pracy :)
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
