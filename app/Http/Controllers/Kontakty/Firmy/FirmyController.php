<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Kontakty\Firmy;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class FirmyController extends Controller {

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
        
        public function listShow()
        {
            $id_user=Auth::user()->id;
            $companies = DB::table('companies')
                    ->join('nips','nips.id','=','companies.id_nip')
                    ->select('companies.*','nips.nip')
                    ->get();
            $favorites = DB::table('favorites')
                    ->where('id_user','=',$id_user)
                    ->where('id_company','>','0')
                    ->select('id','id_user','id_company')
                    ->get();
            
            
            return view('kontakty.firmy.lista')
                    ->with('companies',$companies)
                    ->with('favorites',$favorites);
        }
        
        public function lastListShow()
        {
            $id_user=Auth::user()->id;
            $companies = DB::table('companies')
                    ->join('nips','nips.id','=','companies.id_nip')
                    ->orderBy('id','desc')
                    ->take(5)
                    ->select('companies.*','nips.nip')
                    ->get();
            $favorites = DB::table('favorites')
                    ->where('id_user','=',$id_user)
                    ->where('id_company','>','0')
                    ->select('id','id_user','id_company')
                    ->get();
            
            return view('kontakty.firmy.lista')
                    ->with('companies',$companies)
                    ->with('favorites',$favorites);
        }
        
        public function favoriteAdd($id)
        {
            //id firmy dodawanej do ulubionych
            $data['id']=$id;
            //id zalogowanego uzytkownika
            $id_user=Auth::user()->id;
            
            DB::table('favorites')
                    ->insert(['id_person'=>0,
                        'id_user'=>$id_user,
                        'id_company'=>$data['id']]);     
            
            //wyswietlenie powiadomienia o dodaniu ulubionej firmy
            \Session::flash('success','Dodano firmę do ulubionych!');
            
            return view('kontakty.firmy')->with('success','Dodano firmę do ulubionych!');
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
            $fax_number=DB::table('faxes')
                    ->join('companies','companies.id_fax','=','faxes.id')
                    ->where('companies.id',$id)->pluck('fax');
            $fax_desc=DB::table('faxes')
                    ->join('companies','companies.id_fax','=','faxes.id')
                    ->where('companies.id',$id)->pluck('fax_desc');
            $fax=array('fax'=>$fax_number,
                'fax_desc'=>$fax_desc);
            $www_address=DB::table('pages')
                    ->join('companies','companies.id_www','=','pages.id')
                    ->where('companies.id',$id)->pluck('www');
            $www_desc=DB::table('pages')
                    ->join('companies','companies.id_www','=','pages.id')
                    ->where('companies.id',$id)->pluck('www_desc');
            $www=array('www'=>$www_address,
                'www_desc'=>$www_desc);
//            $companies = DB::table('companies')
//                    ->join('addresses', 'addresses.id', '=', 'companies.id_address')
//                    ->join('countries', 'countries.id', '=', 'companies.id_country')
//                    ->get();
            
            return view('kontakty.firmy.przeglad')->with('name',$name)
                    ->with('country',$country)
                    ->with('address',$address)
                    ->with('nip',$nip)
                    ->with('email',$email)
                    ->with('phone',$phone)
                    ->with('fax',$fax)
                    ->with('www',$www);
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
            $www=$_POST['www'];
            $www_desc=$_POST['www_desc'];
            $fax=$_POST['fax'];
            $fax_desc=$_POST['fax_desc'];
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
            //ustalenie adresu www dla firmy ustalenie opisu dla firmowego maila
            DB::table('pages')->insert(['www'=>$www,
                'www_desc'=>$www_desc]);
            //ustalenie faxu dla firmy ustalenie opisu dla firmowego telefonu
            DB::table('faxes')->insert(['fax'=>$fax,
                'fax_desc'=>$fax_desc]);
            
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
            $id_www=DB::table('pages')
                    ->where('www',$www)
                    ->pluck('id');
            $id_fax=DB::table('faxes')
                    ->where('fax',$fax)
                    ->pluck('id');
            
            DB::table('companies')->insert(['name'=>$name,
                'id_nip'=>$id_nip,
                'id_address'=>$id_address,
                'id_country'=>$id_country,
                'id_email'=>$id_email,
                'id_phone'=>$id_phone,
                'id_www'=>$id_www,
                'id_fax'=>$id_fax]);
            
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
	public function destroy($id)
	{
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
        }
        
}
