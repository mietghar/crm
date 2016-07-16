@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodaj nowe spotkanie</div>
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
                                                'action'=>'Zadania\SpotkaniaController@createNew',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Data *</td>
                                            <td>Godzina *</td>
                                            <td>Firma</td>
                                            <td>Osoba</td></tr>
                                        <tr>
                                            <td>{!! Form::text('date',date('Y-m-d'))!!}</td>
                                            <td>{!! Form::text('time',date('H:i'))!!}</td>
                                            <td>{{$company[0]->company_name}}</td>
                                            {!! Form::hidden('companyname',$company[0]->company_name)!!}
                                            {!! Form::hidden('companyid',$company[0]->company_id)!!}
                                            <td>{{$person[0]->person_name}}</td>
                                            {!! Form::hidden('personname',$person[0]->person_name)!!}
                                            {!! Form::hidden('personid',$person[0]->person_id)!!}</tr>
                                        <tr></table>
                                    
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Komentarz *</td>
                                        </tr>
                                        
                                            <td>{!! Form::textarea('comment',Input::old('comment')) !!}</td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <div class="col-md-4 control-label">
                                            * - Wymagane
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Zaplanuj') !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
				</div>
			</div>
                    <a href="{{url('kontakty/osoby')}}">Wstecz</a>
		</div>
	</div>
</div>

        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script>
        $(function() {
          $( "#datepicker" ).datepicker();
        });
        </script>
@endsection
