@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Przegląd użytkownika</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            @if($data[0]->confirmed==0)
                                            <td style="font-weight: bold; color: green;">Aktywuj</td>
                                            @else
                                            <td style="font-weight: bold; color: red;">Dezaktywuj</td>
                                            @endif
                                            <td>Imię</td>
                                            <td>E-mail</td>
                                            <td>Zespół</td>
                                            <td>Czy aktywny</td>
                                            <td style="font-weight: bold; color: red;">USUŃ</td>
                                        </tr>
                                        <tr>
                                            @if($data[0]->confirmed==0)
                                            <td><a href="aktywuj/{{$data[0]->id}}"><span style="font-weight: bold; color: green;" class="glyphicon glyphicon-thumbs-up" title="Aktywuj" alt="Aktywuj"></span></a></td>
                                            @else
                                            <td><a href="dezaktywuj/{{$data[0]->id}}"><span style="font-weight: bold; color: red;" class="glyphicon glyphicon-thumbs-down" title="Dezaktywuj" alt="Dezaktywuj"></span></a></td>
                                            @endif
                                            <td>{{$data[0]->name}}</td>
                                            <td><a href="mailto:{{$data[0]->email}}">{{$data[0]->email}}</a></td>
                                            @if(isset($team[0]->team_name))
                                            <td>{{$team[0]->team_name}}</td>
                                            @else
                                            <td>BRAK</td>
                                            @endif
                                            @if($data[0]->confirmed==1)
                                            <td style="color: green;">Aktywny</td>
                                            @else
                                            <td style="color: red;">Nieaktywny</td>
                                            @endif
                                            <td><a  style="font-weight: bold; color: red;" href="usun/{{$data[0]->id}}"><span class="glyphicon glyphicon-remove" title="USUŃ" alt="USUŃ"></span></a></td>
                                        </tr>
                                    </table>
				</div>
			</div>
                    <a href="{{url('administracja/uzytkownicy')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
