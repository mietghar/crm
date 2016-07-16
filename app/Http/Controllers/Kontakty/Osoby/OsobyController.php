<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Kontakty\Osoby;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class OsobyController extends Controller {

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
            $persons = DB::table('persons')
                    ->join('companies','companies.id','=','persons.id_company')
                    ->select('persons.*','companies.name as companyname')
                    ->get();
            $favorites = DB::table('favorites')
                    ->where('id_user','=',$id_user)
                    ->where('id_person','>','0')
                    ->select('id','id_user','id_person')
                    ->get();
            
            return view('kontakty.osoby.lista')
                    ->with('persons',$persons)
                    ->with('favorites',$favorites);
        }
        
        public function favoriteAdd($id)
        {
            //id osoby dodawanej do ulubionych
            $data['id']=$id;
            //id zalogowanego uzytkownika
            $id_user=Auth::user()->id;
            
            DB::table('favorites')
                    ->insert(['id_company'=>0,
                        'id_user'=>$id_user,
                        'id_person'=>$data['id']]);     
            
            //wyswietlenie powiadomienia o dodaniu ulubionej firmy
            \Session::flash('success','Dodano osobę do ulubionych!');
            
            return view('kontakty.osoby')->with('success','Dodano osobę do ulubionych!');
        }
        
        public function lastListShow()
        {
            $id_user=Auth::user()->id;
            $persons = DB::table('persons')
                    ->join('companies','companies.id','=','persons.id_company')
                    ->orderBy('id','desc')
                    ->take(5)
                    ->select('persons.*','companies.name as companyname')
                    ->get();
            $favorites = DB::table('favorites')
                    ->where('id_user','=',$id_user)
                    ->where('id_person','>','0')
                    ->select('id','id_user','id_person')
                    ->get();
            
            return view('kontakty.osoby.lista')
                    ->with('persons',$persons)
                    ->with('favorites',$favorites);
        }
        
        
        
        public function personShow($id)
        {
            $name=DB::table('persons')->where('id',$id)->pluck('name');
            $surname=DB::table('persons')->where('id',$id)->pluck('surname');
            $company=DB::table('persons')
                    ->join('companies','companies.id','=','persons.id_company')
                    ->select('companies.name')
                    ->where('persons.id',$id)->pluck('name');
            $id_company=DB::table('persons')
                    ->join('companies','companies.id','=','persons.id_company')
                    ->select('companies.id')
                    ->where('persons.id',$id)->pluck('id');
//            $company=DB::table('persons')
//                    ->join('companies','companies.id','=','persons.id_company')
//                    ->where('id',$id)
//                    ->pluck('companies.name');
            $email_address=DB::table('emails')
                    ->join('persons','persons.id_email','=','emails.id')
                    ->where('persons.id',$id)->pluck('email');
            $email_desc=DB::table('emails')
                    ->join('persons','persons.id_email','=','emails.id')
                    ->where('persons.id',$id)->pluck('email_desc');
            $email=array('email'=>$email_address,
                'email_desc'=>$email_desc);
            $phone_number=DB::table('phones')
                    ->join('persons','persons.id_phone','=','phones.id')
                    ->where('persons.id',$id)->pluck('phone');
            $phone_desc=DB::table('phones')
                    ->join('persons','persons.id_phone','=','phones.id')
                    ->where('persons.id',$id)->pluck('phone_desc');
            $phone=array('phone'=>$phone_number,
                'phone_desc'=>$phone_desc);
//            $companies = DB::table('companies')
//                    ->join('addresses', 'addresses.id', '=', 'companies.id_address')
//                    ->join('countries', 'countries.id', '=', 'companies.id_country')
//                    ->get();
            
            return view('kontakty.osoby.przeglad')
                    ->with('name',$name)
                    ->with('surname',$surname)
                    ->with('email',$email)
                    ->with('company',$company)
                    ->with('id_company',$id_company)
                    ->with('phone',$phone)
                    ->with('id',$id);
//                    ->with('company',$company);
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
        //tworzenie nowej firmy
	public function create()
	{
            $companies=DB::table('companies')
                    ->orderBy('name','asc')
                    ->get();
            return view('kontakty.osoby.dodaj')
                    ->with('companies',$companies);
        }
        
        public function createNew(Requests\CreatePersonRequest $request)
        {   
            OsobyController::create($request->all());
            
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $company=$_POST['companies'];
            $email=$_POST['email'];
            $email_desc=$_POST['email_desc'];
            $phone=$_POST['phone'];
            $phone_desc=$_POST['phone_desc'];
            
            //ustalenie adresu email dla osoby ustalenie opisu dla osobowego maila
            DB::table('emails')->insert(['email'=>$email,
                'email_desc'=>$email_desc]);
            //ustalenie telefonu dla osoby ustalenie opisu dla osobowego telefonu
            DB::table('phones')->insert(['phone'=>$phone,
                'phone_desc'=>$phone_desc]);
            
            $id_email=DB::table('emails')
                    ->where('email',$email)
                    ->pluck('id');
            $id_phone=DB::table('phones')
                    ->where('phone',$phone)
                    ->pluck('id');
            $id_company=DB::table('companies')
                    ->where('name',$company)
                    ->pluck('id');
            
            DB::table('persons')->insert(['name'=>$name,
                'surname'=>$surname,
                'id_company'=>$id_company,
                'id_email'=>$id_email,
                'id_phone'=>$id_phone]);
            
            //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('success','Nowa osoba została dodana!');
            
            return view('kontakty.osoby')->with('success','Dodano nową osobę!');
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
