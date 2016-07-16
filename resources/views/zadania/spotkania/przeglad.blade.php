@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Zestawienie moich spotkań</div>
				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Data</td>
                                            <td>Godzina</td>
                                            <td>Firma</td>
                                            <td>Osoba</td>
                                            <td>Komentarz</td>
                                            <td>Zakończ</td>
                                            <td>Odwołaj</td>
                                        </tr>
                                        @foreach($meetings as $meeting)
                                        <tr>
                                            <td>{{$meeting->date}}</td>
                                            <td>{{$meeting->time}}</td>
                                            <td>{{$meeting->company_name}}</td>
                                            <td>{{$meeting->person_name}}</td>
                                            <td>{{$meeting->comment}}</td>
                                            <td><a href="{{url('zadania/spotkania/zakoncz/')}}{{'/'.$meeting->visitid}}"><span class="glyphicon glyphicon-ok" title="Zakońćż" alt="Zakończ"></span></a></td>
                                            <td>Odwołaj</td>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('zadania')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
