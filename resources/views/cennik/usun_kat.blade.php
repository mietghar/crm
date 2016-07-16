@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuwanie kategorii</div>
                                <div class="panel-heading" style="color: red; font-weight: bold;">Uwaga, niemożliwe jest usunięcie kategorii, do której przypisane są jakieś produkty</div>
				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Kategoria</td>
                                            <td>Usuń</td>
                                        </tr>
                                        @foreach($categories as $category)
                                        <tr><td>{{$category->category}}</td>
                                            <td><a href="usun_kategorie/{{ $category->id}}"><span class="glyphicon glyphicon-remove-circle" alt="Usuń" title="Usuń"></span></a></td></tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('cennik/')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
