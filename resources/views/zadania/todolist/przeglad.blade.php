@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Zestawienie moich zadań</div>
				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Numer zadania</td>
                                            <td>Komentarz</td>
                                            <td>Zakończ</td>
                                        </tr>
                                        <?php $i=0;?>
                                        @foreach($tasks as $task)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$task->comment}}</td>
                                            <td><a href="{{url('zadania/todolist/zakoncz/')}}{{'/'.$task->id_task}}"><span class="glyphicon glyphicon-ok" title="Zakońćż" alt="Zakończ"></span></a></td>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('zadania/todolist')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
