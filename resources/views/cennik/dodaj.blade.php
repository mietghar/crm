@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dodawanie produktów</div>

				<div class="panel-body">
                                    {{ Form::open(array('method'=>'post',
                                                'action'=>'CennikController@index')) }}
                                    {{ Form::label('name','Name') }}
                                    {{ Form::text('name','Testowa wartosc') }}
                                    {{ Form::submit('Dodaj') }}
                                    {{ Form::close() }}
<!--                                    <form class="form-horizontal" id="dodaj_produkt" role="form" title="dodaj produkt" action="../test" method="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <label for="dodaj_produkt">Dodaj produkt</label><br/>
                                        <div class="form-group">    
                                            <label class="col-md-4 control-label" for="name">Nazwa</label>
                                            <div class="col-md-6">
                                                <input type="text" id="name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="category">Kategoria</label>
                                            <div class="col-md-6">
                                                
                                                <select>
                                                    @foreach($categories as $category)
                                                    <option>{{$category->category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="price">Cena</label>
                                            <div class="col-md-6">
                                                <input type="text" id="price"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="currency">Waluta</label>
                                                <div class="col-md-6">
                                                    <select>
                                                        @foreach($currencies as $currency)
                                                        <option>{{$currency->currency}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group">
							<div class="col-xs-12 col-md-offset-0">
								<button type="submit" class="btn btn-primary">
									Dodaj
								</button>
							</div>
						</div>
                                    </form>-->
                                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection