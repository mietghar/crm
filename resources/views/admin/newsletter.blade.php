@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Newsletter</div>

				<div class="panel-body">
                                    {!! Form::open(array('method'=>'post',
                                                'action'=>'Admin\AdminController@sendNews',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Wyślij wiadomość do wszystkich klientów</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! Form::textarea('news','Treść newsa')!!}
                                            </td>
                                        </tr>
                                    </table><div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Wyślij') !!}
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
