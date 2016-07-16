<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <style>
            body { font-family: DejaVu Sans, sans-serif;
            }
            #nr_oferty {
                font-size: 26px;
            }
          </style>
        <div>
            <img src="http://mietech.pl/img/logo_transparent.png"/ width="auto" height="150px">
                 <span id="nr_oferty"><strong>Oferta nr {{ $nr_oferty }}</strong></span>
        </div>
          <hr/>
          <div class="panel panel-default">
				<div class="panel-heading">Oferta</div>

				<div class="panel-body">
                                    <table border="1px" class="table table-bordered">
                                        <tr class="info">
                                            <td>Nazwa</td>
                                            <td>Kategoria</td>
                                            <td>Cena</td>
                                            <td>Rabat</td>
                                            <td>Po rabacie</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>{{$product_name}}</td>
                                            <td>{{$category}}</td>
                                            <td>{{$price}}{{' '}}{{$currency}}{{' netto + VAT'}}</td>
                                            <td>{{$discount}}{{' %'}}</td>
                                            <td>{{$after_discount}}{{' '.$currency.' netto + VAT'}}</td>
                                        </tr>
                                        
                                    </table>
				</div>
			</div>
    </body>
</html>