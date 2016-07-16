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
                                            <td>Nazwa</td>
                                            <td>Adres</td>
                                            <td>Kraj</td>
                                            <td>NIP</td>
                                        </tr>
                                        <tr><td>{{$name}}</td>
                                            <td>{{$address['city']}}, {{$address['street']}}, {{$address['postal']}}</td>
                                            <td>{{$country}}</td>
                                            <td>{{$nip}}</td></tr>
                                    </table>
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>E-mail</td>
                                            <td>Opis</td>
                                            <td>Telefon</td>                                            
                                            <td>Opis</td>
                                            <td>Fax</td>                                            
                                            <td>Opis</td>
                                            <td>www</td>                                            
                                            <td>Opis</td>
                                        </tr>
                                        <tr>
                                            <td><a href="mailto:{{$email['email']}}">{{$email['email']}}</a></td>
                                            <td>{{$email['email_desc']}}</td>
                                            <td>{{$phone['phone']}}</td>
                                            <td>{{$phone['phone_desc']}}</td>
                                            <td>{{$fax['fax']}}</td>                                            
                                            <td>{{$fax['fax_desc']}}</td>
                                            <td><a href="http://{{$www['www']}}">{{$www['www']}}</a></td>                                            
                                            <td>{{$www['www_desc']}}</td>
                                        </tr>
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
