@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista zasobów</div>

				<div class="panel-body">
                                    {!! Form::open(array('method'=>'post',
                                                'action'=>'Admin\AdminController@updateResTo',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa użytkownika</td>
                                            <td>Nazwa zasobu</td>
                                        </tr>
                                        @foreach($res as $re)
                                                <tr><td>{{$re->user_name}}</td>
                                                            <td>
                                                                <select name="{{$re->id_user}}">
                                                                    @foreach($allres as $ares)
                                                                    <option
                                                                        @if($ares->name==$re->res_name)
                                                                        {{{ "selected='selected'"}}}
                                                                        @endif>{{$ares->name}}</option>
                                                                @endforeach
                                                                </select>
                                                            </td>
                                                </tr>
                                        @endforeach
                                    </table><div class="form-group">
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
