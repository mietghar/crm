@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista ulubionych firm</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa</td>
                                            <td>NIP</td>
                                            <td>Pokaż</td>
                                            <td>Usuń</td>
                                        </tr>
                                        @foreach($companies as $company)
                                        <tr><td>{{$company->name}}</td>
                                            <td>{{$company->nip}}</td>
                                        <td><a href="firmy/przeglad/{{ $company->id_company}}"><span class="glyphicon glyphicon-search" alt="Pokaż" title="Pokaż"></span></a></td>
                                        <td><a href="firmy/usun/{{ $company->id}}"><span class="glyphicon glyphicon-remove-circle" alt="Usuń" title="Usuń"></span></a></td></tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty/ulubione')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
