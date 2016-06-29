@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edycja produktów</div>
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
                                                'action'=>'Cennik\CennikController@updateTo',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                    <div class="form-group">
                                        {!! Form::label('name','Nazwa',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('name',$name) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('categories','Kategoria',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            <select name="categories">
                                                @foreach($categories as $category)
                                                
                                                    <option
                                                        @if($category->category==$selectedcategory)
                                                        {{{ "selected='selected'"}}}
                                                        @endif>{{$category->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price','Cena',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('price',$price) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('currencies','Waluta',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            <select name="currencies">
                                                @foreach($currencies as $currency)
                                                    <option
                                                        @if($currency->currency==$selectedcurrency)
                                                        {{{ "selected='selected'"}}}
                                                        @endif
                                                        >{{$currency->currency}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Edytuj') !!}
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ URL::previous() }}">Anuluj</a>                                            
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection