<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Cennik;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class CennikController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
        public function __construct() {
            $this->middleware('admin');
        }
         
	public function index()
	{
            return view('cennik.cennik');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            $products=DB::table('products')->get();
            $currencies=DB::table('currencies')->get();
            $categories=DB::table('categories')->get();
            return view('cennik.dodaj')->with('products',$products)->with('currencies',$currencies)->with('categories',$categories);
	}
        
        public function createNew(Requests\CreateProductRequest $request)
        {   
            CennikController::create($request->all());
            
            
            $name=$_POST['name'];
            $category=$_POST['categories'];
            $price=$_POST['price'];
            $currency=$_POST['currencies'];
            $currency_id=DB::table('currencies')->where('currency',$currency)->pluck('id');
            $category_id=DB::table('categories')->where('category',$category)->pluck('id');
            
            DB::table('products')->insert(['name'=>$name,
            'category'=>$category_id,
            'price'=>$price,
            'currency'=>$currency_id]);
            
            //wyswietlenie powiadomienia o stworzeniu nowego produktu
            \Session::flash('success','Nowy produkt został dodany!');
            
            return view('cennik.cennik')->with('success','Dodano nowy produkt');
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateProductRequest $request)
	{
            
            //validation
            
            CennikController::create($request->all());
            return view('cennik.cennik');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
            $products = DB::table('products')
                    ->join('currencies', 'currencies.id', '=', 'products.currency')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->select('products.name','categories.category','products.price','currencies.currency')
                    ->get();
            
            return view('cennik.przeglad')->with('products',$products);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
            $products = DB::table('products')
                    ->join('currencies', 'currencies.id', '=', 'products.currency')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->select('products.id', 'products.name','categories.category','products.price','currencies.currency')
                    ->get();
            
            return view('cennik.edytuj')->with('products',$products);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            $name=DB::table('products')->where('id',$id)->pluck('name');
            $price=DB::table('products')->where('id',$id)->pluck('price');
            $id=DB::table('products')->where('id',$id)->pluck('id');
            $selectedCategory=DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->where('products.id',$id)->pluck('categories.category');
            $selectedCurrency=DB::table('products')
                    ->join('currencies', 'currencies.id', '=', 'products.currency')
                    ->where('products.id',$id)->pluck('currencies.currency');
//            $products=array('name'=>$name,
//                'price'=>$price,
//                'category'=>$category,
//                'currency'=>$currency,);
            $categories=DB::table('categories')->get();
            $currencies=DB::table('currencies')->get();
//            $products=DB::table('products')->get();
//            $currencies=DB::table('currencies')->get();
//            $categories=DB::table('categories')->get();
            return view('cennik.update')->with('name',$name)
                    ->with('price',$price)
                    ->with('selectedcategory',$selectedCategory)
                    ->with('selectedcurrency',$selectedCurrency)
                    ->with('categories',$categories)
                    ->with('currencies',$currencies)
                    ->with('id',$id);
	
	}
        
        public function updateTo(Requests\EditProductRequest $request){
            CennikController::create($request->all());
            
            $id=$_POST['id'];
            $name=$_POST['name'];
            $category=$_POST['categories'];
            $price=$_POST['price'];
            $currency=$_POST['currencies'];
            $currency_id=DB::table('currencies')->where('currency',$currency)->pluck('id');
            $category_id=DB::table('categories')->where('category',$category)->pluck('id');
            
            DB::table('products')
                    ->where('id',$id)
                    ->update(
                            ['name'=>$name,
                            'category'=>$category_id,
                            'price'=>$price,
                            'currency'=>$currency_id]);
            
            \Session::flash('success','Produkt edytowany prawidłowo!');
            return view('cennik.cennik')->with('success','Dodano nowy produkt');
        }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $data['id']=$id;
            DB::table('products')->where('id', '=', $data['id'])->delete();
            
            //powiadomienie o prawidlowym usunieciu pozycji
            
            \Session::flash('success','Pozycja usunięta prawidłowo!');
            
            return view('cennik.cennik')->with('success','Pozycja usunięta prawidłowo');
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
            
            $products = DB::table('products')
                    ->join('currencies', 'currencies.id', '=', 'products.currency')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->select('products.id', 'products.name','categories.category','products.price','currencies.currency')
                    ->get();
            
            return view('cennik.usun')->with('products',$products);
        }
        
}
