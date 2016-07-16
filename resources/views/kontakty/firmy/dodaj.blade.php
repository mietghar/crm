@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodawanie nowej firmy</div>
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
                                                'action'=>'Kontakty\Firmy\FirmyController@createNew',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <div class="form-group">
                                        {!! Form::label('name','Nazwa *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('name',Input::old('name')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nip','NIP *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('nip',Input::old('nip')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('countries','Kraj *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            <select name="countries">
                                                @foreach($countries as $country)
                                                    <option
                                                        @if($country->pl=='Polska')
                                                        {{{ "selected='selected'"}}}
                                                        @endif>                                                        
                                                        {{$country->pl}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('city','Miasto *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('city',Input::old('city')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span class="glyphicon glyphicon-question-sign" alt="Format: 00-000" title="Format: 00-000"></span>
                                        {!! Form::label('postal','Kod pocztowy *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('postal',Input::old('postal')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('street','Adres *',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('street',Input::old('street')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email','Adres e-mail',array('class'=>'col-md-4 control-label')) !!}
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
                                        {!! Form::label('phone','Numer telefonu',array('class'=>'col-md-4 control-label')) !!}
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
                                        {!! Form::label('fax','Numer fax',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('fax',Input::old('fax')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fax_desc','Opis dla faxu',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('fax_desc',Input::old('fax_desc')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('www','Strona www',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('www',Input::old('www')) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('www_desc','Opis www',array('class'=>'col-md-4 control-label')) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('www_desc',Input::old('www_desc')) !!}
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
                    <a href="{{url('kontakty/firmy')}}">Anuluj</a>
		</div>
	</div>
</div>
@endsection