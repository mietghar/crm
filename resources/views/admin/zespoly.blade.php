@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista zespołów</div>

				<div class="panel-body">
                                    {!! Form::open(array('method'=>'post',
                                                'action'=>'Admin\AdminController@updateTeamTo',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa użytkownika</td>
                                            <td>Nazwa zespołu</td>
                                        </tr>
                                        @foreach($teams as $team)
                                                <tr><td>{{$team->user_name}}</td>
                                                            <td>
                                                                <select name="{{$team->id_user}}">
                                                                    @foreach($allteams as $allteam)
                                                                    <option
                                                                        @if($allteam->name==$team->team_name)
                                                                        {{{ "selected='selected'"}}}
                                                                        @endif>{{$allteam->name}}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                </tr>
                                        @endforeach
                                    </table>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Edytuj') !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
				</div>
                                    
				</div>
                    <a href="{{url('administracja')}}">Wstecz</a>
			</div>
		</div>
	</div>
</div>
@endsection
