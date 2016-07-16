@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodaj nowe zadanie</div>
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
                                                'action'=>'Zadania\ToDoListController@createNew',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Komentarz do zadania *</td>
                                        </tr>
                                        <tr>
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
                    <a href="{{url('zadania/todolist')}}">Wstecz</a>
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
