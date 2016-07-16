@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Zestawienie zadań wszystkich zespołów</div>
				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nr</td>
                                            <td>Odpowiedzialny</td>
                                            <td>Komentarz</td>
                                        </tr>
                                        <?php $i=0;?>
                                        @foreach($tasks as $task)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$task->user_name}}, <a href="mailto:{{$task->user_email}}">{{$task->user_email}}</a></td>
                                            <td>{{$task->comment}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('zadania')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
