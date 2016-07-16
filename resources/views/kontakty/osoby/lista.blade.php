@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista znanych osób</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Imię</td>
                                            <td>Nazwisko</td>
                                            <td>Pokaż</td>
                                            <td>Dodaj do ulubionych</td>
                                        </tr>
                                        <?php $wysw=0;?>
                                        @foreach($persons as $person)
                                                <tr><td>{{$person->name}}</td>
                                                    <td>{{$person->surname}}</td>
                                                <td><a href="przeglad/{{ $person->id}}"><span class="glyphicon glyphicon-search" alt="Pokaż" title="Pokaż"></span></a></td>
                                                @for($j=0; $j<count($favorites);$j++)
                                                    @if(array_key_exists($j,$favorites))
                                                        @if($person->id == $favorites[$j]->id_person)
                                                            <td><span class="glyphicon glyphicon-heart" alt="Ulubione" title="Ulubione" style="color: red;"></span></td></tr>
                                                            <?php $wysw=1;?>
                                                        @endif
                                                    @endif
                                                @endfor
                                                @if($wysw==0)
                                                <td><a href="ulubione/{{ $person->id}}"><span class="glyphicon glyphicon-heart" alt="Dodaj do ulubionych" title="Dodaj do ulubionych"></span></a></td></tr>
                                                @endif
                                                <?php $wysw=0;?>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('kontakty')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
