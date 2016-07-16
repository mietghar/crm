<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Kontakty;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class KontaktyController extends Controller {

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
            return view('kontakty.firmy');
        }
        
        public function teamsShow()
        {
            //pobranie id uzytkownia
            $user=Auth::user()->id;
            //pobranie nazwy zespolu w ktorym jest uzytkownik
            $mtid=DB::table('teams')
                    ->join('teams_assignment','teams_assignment.id_team','=','teams.id')
                    ->where('teams_assignment.id_user','=',$user)
                    ->select('teams.id as id')
                    ->pluck('id');
            $myteam=DB::table('teams')
                    ->join('teams_assignment','teams_assignment.id_team','=','teams.id')
                    ->join('users','users.id','=','teams_assignment.id_user')
                    ->select('users.email as email','users.name as user','teams.name as name')
                    ->where('teams_assignment.id_team','=',$mtid)
                    ->orderBy('name','asc')
                    ->get();
            $teams=DB::table('teams')
                    ->join('teams_assignment','teams_assignment.id_team','=','teams.id')
                    ->join('users','users.id','=','teams_assignment.id_user')
                    ->select('users.email as email','users.name as user','teams.name as name')
                    ->orderBy('name','asc')
                    ->get();
            return view('kontakty.zespol.zespol')
                    ->with('myteam',$myteam)
                    ->with('teams',$teams);
                    
//                ->with('teams',$teams);
        }
        
        public function personsShow()
        {
//            $persons = DB::table('persons')->get();
//            
//            return view('kontakty.osoby')->with('persons',$persons);
            return view('kontakty.osoby');
        }
        
        public function favoritesShow()
        {
            $persons=DB::table('persons')
                    ->join('favorites','favorites.id_person','=','persons.id')
                    ->get();
            $companies=DB::table('companies')
                    ->join('favorites','favorites.id_company','=','companies.id')
                    ->get();
            $favorites=array('persons'=>$persons,
                'companies'=>$companies);
            return view('kontakty.ulubione')->with('favorites',$favorites);
        }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            
        }
        
        public function createNew(Requests\CreateProductRequest $request)
        {   
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
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
        }
        
}
