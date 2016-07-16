@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodawanie nowej osoby</div>
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
                                                'action'=>'Kontakty\Osoby\OsobyController@createNew',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <div class="form-group">
                                        {!! Form::label('name','Imię *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('name',Input::old('name')) !!}
                                        </div>
                                    </div><div class="form-group">
                                        {!! Form::label('surname','Nazwisko *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('surname',Input::old('surname')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('companies','Zatrudnienie *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            <select name="companies">
                                                @foreach($companies as $company)
                                                <option>{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email','Adres e-mail *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('email',Input::old('email')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email_desc','Opis dla adresu e-mail',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('email_desc',Input::old('email_desc')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone','Numer telefonu *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('phone',Input::old('phone')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone_desc','Opis dla telefonu',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('phone_desc',Input::old('phone_desc')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 control-label">
                                            * - Wymagane
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
                    <a href="{{url('kontakty/osoby')}}">Anuluj</a>
		</div>
	</div>
</div>
@endsection