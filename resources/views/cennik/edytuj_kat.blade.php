@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edycja kategorii</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Kategoria</td>
                                            <td>Edytuj</td>
                                        </tr>
                                        @foreach($categories as $category)
                                        <tr><td>{{$category->category}}</td>
                                            <td><a href="edytuj_kategorie/{{ $category->id}}"><span class="glyphicon glyphicon-edit" alt="Edytuj produkt" title="Edytuj produkt"></span></a></td></tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('cennik/')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
