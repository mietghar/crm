@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edycja kategorii</div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
				<div class="panel-body">
                                    {!! Form::open(array('method'=>'post',
                                                'action'=>'Cennik\CennikController@updateToCategory',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                    <div class="form-group">
                                        {!! Form::label('category','Nazwa kategorii',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('category',$category) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Edytuj') !!}
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{url('cennik/')}}">Anuluj</a>                                            
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection