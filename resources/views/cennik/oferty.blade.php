@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Lista ofert</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa firmy</td>
                                            <td>Nr oferty</td>
                                            <td>Autor oferty</td>
                                            <td>Przedmiot oferty</td>
                                            <td>Cena</td>
                                            <td>Rabat</td>
                                            <td>Cena po rabacie</td>
                                        </tr>
                                        @foreach($offers as $offer)
                                                <tr>
                                                    <td>{{$offer->company}}</td>
                                                    <td>{{substr($offer->offer_name,64,-4)}}</td>
                                                    <td>{{$offer->user_name}}</td>
                                                    <td>{{$offer->product_name}}</td>
                                                    <td>{{$offer->price.' '}}{{$offer->currency.' netto + VAT'}}</td>
                                                    <td>{{$offer->discount}}</td>
                                                    <td>{{$offer->price_discounted.' '}}{{$offer->currency.' netto + VAT'}}</td>
                                                </tr>
                                        @endforeach
                                    </table>
				</div>
			</div>
                    <a href="{{url('cennik.cennik')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
