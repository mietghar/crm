<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Kontakty\Ulubione;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class UlubioneController extends Controller {

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
            return view('kontakty.kontakty');
	}
        
        public function companiesShow()
        {
            $id_user=Auth::user()->id;
            $companies = DB::table('favorites')
                    ->join('companies','companies.id','=','favorites.id_company')
                    ->join('nips','nips.id','=','companies.id_nip')
                    ->where('favorites.id_user','=',$id_user)
                    ->select('companies.name','companies.id as id_company','favorites.id','nips.nip')
                    ->get();
            
            return view('kontakty.ulubione.firmy.lista')
                    ->with('companies',$companies);
        }
        
        public function personsShow()
        {
            $id_user=Auth::user()->id;
            $persons = DB::table('favorites')
                    ->join('persons','persons.id','=','favorites.id_person')
                    ->join('companies','companies.id','=','persons.id_company')
                    ->where('favorites.id_user','=',$id_user)
                    ->select('persons.name','persons.id as id_person','persons.surname','favorites.id','companies.name as companyname')
                    ->get();
            
            return view('kontakty.ulubione.osoby.lista')
                    ->with('persons',$persons);
        }
        
        
        
        public function companyShow($id)
        {
            $name=DB::table('companies')->where('id',$id)->pluck('name');
            $country=DB::table('countries')
                    ->join('companies','companies.id_country','=','countries.id')
                    ->where('companies.id',$id)->pluck('pl');
            $nip=DB::table('nips')
                    ->join('companies','companies.id_nip','=','nips.id')
                    ->where('companies.id',$id)->pluck('nip');
            $city=DB::table('addresses')
                    ->join('companies','companies.id_address','=','addresses.id')
                    ->where('companies.id',$id)->pluck('city');
            $street=DB::table('addresses')
                    ->join('companies','companies.id_address','=','addresses.id')
                    ->where('companies.id',$id)->pluck('street');
            $postal=DB::table('addresses')
                    ->join('companies','companies.id_address','=','addresses.id')
                    ->where('companies.id',$id)->pluck('postal');
            $address=array('city'=>$city,
                'postal'=>$postal,
                'street'=>$street);
            $email_address=DB::table('emails')
                    ->join('companies','companies.id_email','=','emails.id')
                    ->where('companies.id',$id)->pluck('email');
            $email_desc=DB::table('emails')
                    ->join('companies','companies.id_email','=','emails.id')
                    ->where('companies.id',$id)->pluck('email_desc');
            $email=array('email'=>$email_address,
                'email_desc'=>$email_desc);
            $phone_number=DB::table('phones')
                    ->join('companies','companies.id_phone','=','phones.id')
                    ->where('companies.id',$id)->pluck('phone');
            $phone_desc=DB::table('phones')
                    ->join('companies','companies.id_phone','=','phones.id')
                    ->where('companies.id',$id)->pluck('phone_desc');
            $phone=array('phone'=>$phone_number,
                'phone_desc'=>$phone_desc);
//            $companies = DB::table('companies')
//                    ->join('addresses', 'addresses.id', '=', 'companies.id_address')
//                    ->join('countries', 'countries.id', '=', 'companies.id_country')
//                    ->get();
            
            return view('kontakty.firmy.przeglad')->with('name',$name)
                    ->with('country',$country)
                    ->with('address',$address)
                    ->with('nip',$nip)
                    ->with('email',$email)
                    ->with('phone',$phone);
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
        //tworzenie nowej firmy
	public function create()
	{
            $companies=DB::table('companies')->get();
            $countries=DB::table('countries')->get();
            return view('kontakty.firmy.dodaj')
                    ->with('countries',$countries)
                    ->with('companies',$companies);
        }
        
        public function createNew(Requests\CreateCompanyRequest $request)
        {   
            FirmyController::create($request->all());
            
            $name=$_POST['name'];
            $nip=$_POST['nip'];
            $street=$_POST['street'];
            $city=$_POST['city'];
            $postal=$_POST['postal'];
            $country=$_POST['countries'];
            $email=$_POST['email'];
            $email_desc=$_POST['email_desc'];
            $phone=$_POST['phone'];
            $phone_desc=$_POST['phone_desc'];
            //ustalenie nipu
            DB::table('nips')->insert(['nip'=>$nip]);
            $id_nip=DB::table('nips')->where('nip',$nip)->pluck('id');
            //ustalenie kodu pocztowego, adresu i miasta
            DB::table('addresses')->insert(['street'=>$street,
                'city'=>$city,
                'postal'=>$postal]);
            //ustalenie adresu email dla firmy ustalenie opisu dla firmowego maila
            DB::table('emails')->insert(['email'=>$email,
                'email_desc'=>$email_desc]);
            //ustalenie telefonu dla firmy ustalenie opisu dla firmowego telefonu
            DB::table('phones')->insert(['phone'=>$phone,
                'phone_desc'=>$phone_desc]);
            
            $id_address=DB::table('addresses')
                    ->where('city',$city)
                    ->where('postal',$postal)
                    ->where('street',$street)
                    ->pluck('id');
            $id_country=DB::table('countries')
                    ->where('pl',$country)
                    ->pluck('id');
            $id_email=DB::table('emails')
                    ->where('email',$email)
                    ->pluck('id');
            $id_phone=DB::table('phones')
                    ->where('phone',$phone)
                    ->pluck('id');
            
            DB::table('companies')->insert(['name'=>$name,
                'id_nip'=>$id_nip,
                'id_address'=>$id_address,
                'id_country'=>$id_country,
                'id_email'=>$id_email,
                'id_phone'=>$id_phone]);
            
            //wyswietlenie powiadomienia o stworzeniu nowej firmy
            \Session::flash('success','Nowa firma została dodana!');
            
            return view('kontakty.firmy')->with('success','Dodano nową firmę!');
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateCompanyRequest $request)
	{
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	}
        
        public function updateTo(Requests\EditProductRequest $request){
        }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function companyDestroy($id)
	{
            $user_id=Auth::user()->id;
            $data['id']=$id;
            $db_user_id=DB::table('favorites')
                    ->where('favorites.id','=',$data['id'])
                    ->where('id_user','=',$user_id)
                    ->pluck('id_user');
            
            //sprawdzenie czy "ulubione" ktore chcemy usunac naleza
            //do zalogowanego uzytkownika
            if($user_id === $db_user_id){
                
                 DB::table('favorites')
                    ->where('favorites.id', '=', $data['id'])
                    ->delete();
            
                //powiadomienie o prawidlowym usunieciu pozycji

                \Session::flash('success','Pozycja usunięta prawidłowo!');

                return view('kontakty.ulubione')->with('success','Pozycja usunięta prawidłowo');
            }
            else {
                //powiadomienie o niepowodzeniu
            
            \Session::flash('danger','Coś poszło nie tak! :(');
            
            return view('kontakty.ulubione')->with('danger','Coś poszło nie tak! :(');
            }
            
	}
        
        public function personDestroy($id)
	{
            $user_id=Auth::user()->id;
            $data['id']=$id;
            $db_user_id=DB::table('favorites')
                    ->where('favorites.id','=',$data['id'])
                    ->where('id_user','=',$user_id)
                    ->pluck('id_user');
            
            //sprawdzenie czy "ulubione" ktore chcemy usunac naleza
            //do zalogowanego uzytkownika
            if($user_id === $db_user_id){
                
                 DB::table('favorites')
                    ->where('favorites.id', '=', $data['id'])
                    ->delete();
            
                //powiadomienie o prawidlowym usunieciu pozycji

                \Session::flash('success','Pozycja usunięta prawidłowo!');

                return view('kontakty.ulubione')->with('success','Pozycja usunięta prawidłowo');
            }
            else {
                //powiadomienie o niepowodzeniu
            
            \Session::flash('danger','Coś poszło nie tak! :(');
            
            return view('kontakty.ulubione')->with('danger','Coś poszło nie tak! :(');
            }
            
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
        }
        
}
