@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista ulubionych osób</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Imię</td>
                                            <td>Nazwisko</td>
                                            <td>Zatrudnienie</td>
                                            <td>Pokaż</td>
                                            <td>Usuń</td>
                                        </tr>
                                        @foreach($persons as $person)
                                        <tr><td>{{$person->name}}</td>
                                            <td>{{$person->surname}}</td>
                                            <td>{{$person->companyname}}</td>
                                        <td><a href="osoby/przeglad/{{ $person->id_person}}"><span class="glyphicon glyphicon-search" alt="Pokaż" title="Pokaż"></span></a></td>
                                        <td><a href="osoby/usun/{{ $person->id}}"><span class="glyphicon glyphicon-remove-circle" alt="Usuń" title="Usuń"></span></a></td></tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty/ulubione')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
