<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Cennik;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use PDF;
use App;
use DB;
use Illuminate\Http\Request;

class OfertaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
        public function __construct() {
            $this->middleware('admin');
        }
        
        public function ofertyShow() {
            $offers=DB::table('offers')
                    ->join('companies','companies.id','=','offers.id_company')
                    ->join('users','users.id','=','offers.id_user')
                    ->join('products','products.id','=','offers.id_product')
                    ->select('users.name as user_name',
                            'companies.name as company',
                            'products.name as product_name',
                            'offers.price as price',
                            'offers.after_discount as price_discounted',
                            'offers.currency as currency',
                            'offers.discount as discount',
                            'offers.path as offer_name')
                    ->get();
            return view('cennik.oferty')
                    ->with('offers',$offers);
        }
        
        public function krok1($id)
        {
            $product_id=$id;
            $product=DB::table('products')
                    ->join('categories','categories.id','=','products.category')
                    ->join('currencies','currencies.id','=','products.currency')
                    ->where('products.id','=',$id)
                    ->select('products.id','products.name','categories.category','products.price','currencies.currency')
                    ->get();
            $companies=DB::table('companies')
                    ->join('emails','emails.id','=','companies.id_email')
                    ->where('emails.email','!=','')
                    ->select('companies.id','companies.name','emails.email')
                    ->get();
            return view('cennik.oferta.krok1')
                    ->with('companies',$companies)
                    ->with('product',$product);
        }
        
        public function krok2()
        {
            //echo public_path();
            $id_oferty=DB::table('offers')
                    ->select('id')
                    ->orderBy('id','desc')
                    ->take(1)
                    ->pluck('id')+1;
            $id_product=$_POST['id_product'];
            $nr_oferty = 'OFE/'.$id_oferty.'/MIETECH/'.date('Y');
            $after_discount=$_POST['price']*(1-intval($_POST['discount'])/100);
            
            $product=array('nr_oferty'=>$nr_oferty,
                    'product_name'=>$_POST['product_name'],
                    'category'=>$_POST['category'],
                    'price'=>$_POST['price'],
                    'currency'=>$_POST['currency'],
                    'company'=>$_POST['company'],
                    'discount'=>$_POST['discount'],
                    'after_discount'=>$after_discount);
            $nazwa_oferty='OFE_'.$id_oferty.'_MIETECH_'.date('Y');
            $pdf= PDF::loadView('test.test3', $product)->save(public_path().'/oferty/'.$nazwa_oferty.'.pdf');

            
            
            $emails=DB::table('persons')
                    ->join('emails','emails.id','=','persons.id_email')
                    ->select('emails.email as email')
                    ->get();
            $email['oferta']=$nazwa_oferty;
            $email['adresat']=DB::table('emails')
                    ->join('companies','companies.id_email','=','emails.id')
                    ->where('companies.name','=',$_POST['company'])
                    ->select('emails.email')
                    ->pluck('emails.email');
            
            
            
                Mail::send('emails.offer', $email ,function($message) use ($email){
                    $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Mietech.pl oferta nr '.$email['oferta']);
                    $message->attach(public_path().'/oferty/'.$email['oferta'].'.pdf');
                    $message->to($email['adresat']);
                    }
                    );
                    
                    $id_company=DB::table('companies')
                            ->where('companies.name','=',$_POST['company'])
                            ->pluck('companies.id');
                    
                 //zapisanie oferty do bazy danych
                DB::table('offers')
                        ->insert(['id_user'=>Auth::user()->id,
                            'id_company'=>$id_company,
                            'id_product'=>$id_product,
                            'price'=>$_POST['price'],
                            'currency'=>$_POST['currency'],
                            'discount'=>$_POST['discount'],
                            'after_discount'=>$after_discount,
                            'path'=>  public_path().'/oferty/'.$nazwa_oferty.'.pdf']);
                    
            
            
            //wyswietlenie powiadomienia o wyslaniu nowej oferty
            \Session::flash('success','Oferta wysłana do firmy '.$product['company'].'.');
            
            return view('cennik.cennik')->with('success','Oferta wysłana do firmy '.$product['company'].'.');
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
            return view('cennik.dodaj')
                    ->with('products',$products)
                    ->with('currencies',$currencies)
                    ->with('categories',$categories);
	}
        
        public function createCategory()
	{
            return view('cennik.dodaj_kat');
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
        
        public function createNewCategory(Requests\CreateCategoryRequest $request)
        {   
            CennikController::createCategory($request->all());
            
            
            $category=$_POST['category'];
            $category_id=DB::table('categories')->where('category',$category)->pluck('id');
            
            DB::table('categories')->insert(['category'=>$category]);
            
            //wyswietlenie powiadomienia o stworzeniu nowego produktu
            \Session::flash('success','Nowa kategoria została dodana!');
            
            return view('cennik.cennik')->with('success','Nowa kategoria została dodana!');
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
                    ->select('products.id','products.name','categories.category','products.price','currencies.currency')
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
        
        public function editCategory()
	{
            $categories = DB::table('categories')->get();
            
            return view('cennik.edytuj_kat')->with('categories',$categories);
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
        
        public function updateCategory($id)
	{
            $category=DB::table('categories')
                    ->where('categories.id','=',$id)
                    ->pluck('category');
            return view('cennik.update_kat')
                    ->with('category',$category)
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
        
        public function updateToCategory(Requests\EditCategoryRequest $request){
            CennikController::create($request->all());
            
            $category=$_POST['category'];
            $category_id=$_POST['id'];
            var_dump($category_id);
            DB::table('categories')
                    ->where('id',$category_id)
                    ->update(['category'=>$category]);
            
            \Session::flash('success','Kategoria edytowana prawidłowo!');
            return view('cennik.cennik')->with('success','Kategoria edytowana prawidłowo!');
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
        
        public function destroyCategory($id)
	{
            $data['id']=$id;
            //wyciagniecie tabeli produktow z ta kategoria
            $products_with_category=DB::table('products')
                    ->join('categories','categories.id','=','products.category')
                    ->where('categories.id','=',$id)
                    ->select('products.name')
                    ->get();
            //sprawdzenie czy do kategorii są przypisane jakieś pozycje w cenniku
            if(count($products_with_category)==0){
            DB::table('categories')->where('id', '=', $data['id'])->delete();
            
            //powiadomienie o prawidlowym usunieciu kategorii
            
            \Session::flash('success','Kategoria usunięta prawidłowo!');
            
            return view('cennik.cennik')->with('success','Kategoria usunięta prawidłowo!');
            }
            else {
            //powiadomienie o nieprawidlowym usunieciu kategorii
            
            \Session::flash('danger','Kategoria nie została usunięta prawidłowo!');
            
            return view('cennik.cennik')->with('danger','Kategoria nie została usunięta prawidłowo!');
                
            }
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
        
        //generowanie widoku dla usuwania kategorii
        public function deleteCategory(){
            
            $categories = DB::table('categories')->get();
            
            return view('cennik.usun_kat')->with('categories',$categories);
        }
        
}
