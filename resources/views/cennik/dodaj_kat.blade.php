@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodawanie nowej kategorii</div>
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
                                                'action'=>'Cennik\CennikController@createNewCategory',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <div class="form-group">
                                        {!! Form::label('category','Nazwa kategorii',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('category',Input::old('category')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Dodaj') !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    
				</div>
			</div>
                    <a href="{{URL::previous()}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection