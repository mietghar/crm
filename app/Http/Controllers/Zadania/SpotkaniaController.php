<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Zadania;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class SpotkaniaController extends Controller {

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
            return view('zadania.spotkania');
	}
        
        public function meetingsShow()
        {
            $userid=Auth::user()->id;
            $meetings=DB::table('visits')
                    ->join('persons','persons.id','=','visits.id_person')
                    ->join('companies','companies.id','=','visits.id_company')
                    ->join('users','users.id','=','visits.id_user')
                    ->select('persons.name as person_name',
                            'companies.name as company_name',
                            'users.name as user_name',
                            'users.email as user_email',
                            'visits.comment as comment',
                            'visits.date as date',
                            'visits.time as time',
                            'visits.id as visitid')
                    ->where('users.id','=',$userid)
                    ->orderBy('date','asc')
                    ->get();
            return view('zadania.spotkania.przeglad')
                    ->with('meetings',$meetings);
        }
        
        public function closedMeetingsShow()
        {
            $userid=Auth::user()->id;
            $meetings=DB::table('closed_visits')
                    ->join('persons','persons.id','=','closed_visits.id_person')
                    ->join('companies','companies.id','=','closed_visits.id_company')
                    ->join('users','users.id','=','closed_visits.id_user')
                    ->select('persons.name as person_name',
                            'companies.name as company_name',
                            'users.name as user_name',
                            'users.email as user_email',
                            'closed_visits.comment as comment',
                            'closed_visits.date as date',
                            'closed_visits.time as time')
                    ->orderBy('date','asc')
                    ->orderBy('company_name','asc')
                    ->get();
            return view('zadania.spotkania.zakonczone')
                    ->with('meetings',$meetings);
        }
        
        public function teamShow()
        {
            
            return view('zadania.zespol');
        }
        public function todolistShow()
        {
            
            return view('zadania.todolist');
        }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
            $person=DB::table('persons')
                    ->where('persons.id','=',$id)
                    ->select('name as person_name','id as person_id')
                    ->get();
            $company=DB::table('companies')
                    ->join('persons','persons.id_company','=','companies.id')
                    ->where('persons.id','=',$id)
                    ->select('companies.name as company_name','companies.id as company_id')
                    ->get();
            return view('zadania.spotkania.dodaj')
                    ->with('person',$person)
                    ->with('company',$company);
        }
        
        public function createNew(Requests\CreateMeetingRequest $request)
        {   
            SpotkaniaController::create($request->all());
            
            $iduser=Auth::user()->id;
            $companyname=$_POST['companyname'];
            $personname=$_POST['personname'];
            $companyid=$_POST['companyid'];
            $personid=$_POST['personid'];
            $comment=$_POST['comment'];
            $date=$_POST['date'];
            $time=$_POST['time'];
            
            
            DB::table('visits')->insert(['id_user'=>$iduser,
                'comment'=>$comment,
                'id_company'=>$companyid,
                'id_person'=>$personid,
                'date'=>$date,
                'time'=>$time]);
            
            //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('success','Dodano nowe spotkanie!');
            
            return view('zadania.zadania')->with('success','Dodano nowe spotkanie!');
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateProductRequest $request)
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
            $visitid=$id;
            //skopiowanie danych zakonczonej wizyty
            $wizyta1=DB::table('visits')
                    ->where('visits.id','=',$visitid)
                    ->get();
            //wklejenie do zakonczonych wizyt
            DB::table('closed_visits')
                    ->insert(['comment'=>$wizyta1[0]->comment,
                        'id_user'=>$wizyta1[0]->id_user,
                        'id_company'=>$wizyta1[0]->id_company,
                        'id_person'=>$wizyta1[0]->id_person,
                        'date'=>$wizyta1[0]->date,
                        'time'=>$wizyta1[0]->time]);
            DB::table('visits')
                    ->where('visits.id','=',$visitid)
                    ->delete();
            
            
            //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('success','Spotkanie zakończone!');
            
            return view('zadania.zadania')->with('success','Spotkanie zakończone!');
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
        }
        
}
