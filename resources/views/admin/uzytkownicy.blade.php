@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista użytkowników</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Imię</td>
                                            <td>E-mail</td>
                                            <td>Pokaż</td>
                                        </tr>
                                        <?php $wysw=0;?>
                                        @foreach($users as $user)
                                                <tr><td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                <td><a href="uzytkownicy/przeglad/{{ $user->id}}"><span class="glyphicon glyphicon-search" alt="Pokaż" title="Pokaż"></span></a></td>
                                                
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('administracja')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
