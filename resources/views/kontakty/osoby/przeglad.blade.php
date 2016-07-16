@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $name }}</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Imię</td>
                                            <td>Nazwisko</td>
                                            <td>Zatrudnienie</td>
                                            <td>Zaplanuj spotkanie</td>
                                        </tr>
                                        <tr><td>{{$name}}</td>
                                            <td>{{$surname}}</td>
                                            <td><a href="{{url('kontakty/firmy/przeglad').'/'}}{{$id_company}}">{{$company}}</a></td>
                                            <td><a href="{{url('zadania/spotkania/dodaj').'/'}}{{$id}}">Zaplanuj spotkanie</a></td>
                                        </tr>
                                    </table>
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>E-mail</td>
                                            <td>Opis</td>
                                            <td>Telefon</td>                                            
                                            <td>Opis</td>
                                        </tr>
                                        <tr>
                                            <td><a href="mailto:{{$email['email']}}">{{$email['email']}}</a></td>
                                            <td>{{$email['email_desc']}}</td>
                                            <td>{{$phone['phone']}}</td>
                                            <td>{{$phone['phone_desc']}}</td>
                                        </tr>
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty\osoby\lista')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
