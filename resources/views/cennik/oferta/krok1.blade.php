@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Krok 1 oferty</div>

				<div class="panel-body">
                                    {!! Form::open(array('method'=>'post',
                                                'action'=>'Cennik\OfertaController@krok2',
                                                'class'=>'form-horizontal')) !!}
                                    {!! Form::token() !!}
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa</td>
                                            <td>Kategoria</td>
                                            <td>Cena</td>
                                            <td>Waluta</td>
                                            <td>Firma</td>
                                        </tr>{!!Form::hidden('id_product',$product[0]->id)!!}
                                        <tr><td>{{$product[0]->name}}{!!Form::hidden('product_name',$product[0]->name)!!}</td>
                                            <td>{{$product[0]->category}}{!!Form::hidden('category',$product[0]->category)!!}</td>
                                            <td>{{$product[0]->price}}{!!Form::hidden('price',$product[0]->price)!!}</td>
                                            <td>{{$product[0]->currency}}{!!Form::hidden('currency',$product[0]->currency)!!}</td>
                                                    <td>
                                                        <select name="company">
                                                            @foreach($companies as $company)
                                                            <option id="{{$company->id}}}">{{$company->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                        </tr>
                                        <tr class="info">
                                            <td>
                                                Ustal rabat %
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="discount">
                                                            @for($i=0; $i<=95; $i=$i+5)
                                                            <option id="{{$i}}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                            </td>
                                        </tr>
                                    </table><div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::submit('Wyślij') !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
				</div>
			</div>
                    <a href="{{URL('cennik/')}}">Wstecz</a>
		</div>
	</div>
</div>
@endsection
