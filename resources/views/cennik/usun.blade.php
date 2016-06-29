@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Przegląd produktów</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa</td>
                                            <td>Kategoria</td>
                                            <td>Cena</td>
                                            <td>Waluta</td>
                                            <td>Usuń</td>
                                        </tr>
                                        @foreach($products as $product)
                                        <tr><td>{{$product->name}}</td>
                                            <td>{{$product->category}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->currency}}</td>
                                            <td><a href="usun/{{ $product->id}}">Usuń</a></td></tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
