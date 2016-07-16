@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista osób w zespole</div>
                                <div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <thead>Mój zespół</thead>
                                        <tr class="info">
                                            <td>Użytkownik</td>
                                            <td>Nazwa zespołu</td>
                                        </tr>
                                        @foreach($myteam as $myteamid)
                                        <tr>
                                            <td>{{$myteamid->user}}, {{$myteamid->email}}</td>
                                            <td>{{$myteamid->name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
				</div>
				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <thead>Pozostałe zespoły</thead>
                                        <tr class="info">
                                            <td>Użytkownik</td>
                                            <td>Nazwa zespołu</td>
                                        </tr>
                                        @foreach($teams as $team)
                                        <tr>
                                            <td>{{$team->user}}, {{$team->email}}</td>
                                            <td>{{$team->name}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty/')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
