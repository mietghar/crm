<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Mail;

use Illuminate\Http\Request;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
        public function __construct() {
            $this->middleware('admin');
            $this->middleware('root');
        }
         
	public function index()
	{
            return view('admin.admin');
	}
        public function usersShow()
        {
            $users=DB::table('users')
                    ->select('users.id',
                            'users.name',
                            'users.email',
                            'users.confirmed')
                    ->orderBy('users.name','asc')
                    ->get();
            return view('admin.uzytkownicy')
                    ->with('users',$users);
        }
        public function userEdit($id)
        {
            $data=DB::table('users')
                    ->select('users.name',
                            'users.id',
                            'users.email',
                            'users.confirmed')
                    ->where('users.id','=',$id)
                    ->get();
            $team=DB::table('teams')
                    ->join('teams_assignment','teams_assignment.id_team','=','teams.id')
                    ->join('users','users.id','=','teams_assignment.id_user')
                    ->select('teams.name as team_name')
                    ->where('users.id','=',$id)
                    ->get();
            return view('admin.uzytkownicy.edytuj')
                    ->with('data',$data)
                    ->with('team',$team);
        }
        public function teamsShow()
        {
            $teams=DB::table('teams')
                    ->join('teams_assignment','teams_assignment.id_team','=','teams.id')
                    ->join('users','users.id','=','teams_assignment.id_user')
                    ->select('users.name as user_name',
                            'users.id as id_user',
                            'teams.id as id_team',
                            'teams.name as team_name')
                    ->orderBy('team_name','asc')
                    ->orderBy('user_name','asc')
                    ->get();
            $allteams=DB::table('teams')
                    ->get();
            
            return view('admin.zespoly')
                    ->with('teams',$teams)
                    ->with('allteams',$allteams);
        }
        public function resourcesShow()
        {
            
            $res=DB::table('resources')
                    ->join('resources_assignment','resources_assignment.id_res','=','resources.id')
                    ->join('users','users.id','=','resources_assignment.id_user')
                    ->select('users.name as user_name',
                            'users.id as id_user',
                            'resources.id as id_res',
                            'resources.name as res_name')
                    ->orderBy('res_name','asc')
                    ->orderBy('user_name','asc')
                    ->get();
            $allres=DB::table('resources')
                    ->get();
            
            return view('admin.zasoby')
                    ->with('res',$res)
                    ->with('allres',$allres);
        }
        public function newsletterShow()
        {
            return view('admin.newsletter');
        }
        
        public function sendNews()
        {
            $news=$_POST['news'];
            $emails=DB::table('persons')
                    ->join('emails','emails.id','=','persons.id_email')
                    ->select('emails.email as email')
                    ->get();
            $email['news']=$news;
            for($i=0; $i<count($emails);$i++)
            {
                $email[0]=$emails[$i]->email;
                Mail::send('emails.news', $email ,function($message) use ($email){
                    $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('CRM mietech.pl NEWS');
                    $message->to($email[0]);
                    }
                    );
            }
            
                //wyswietlenie powiadomienia o wyslaniu newslettera
                     \Session::flash('success','Newsletter wysłany!');
            
                    return view('admin.admin')->with('success','Newsletter wysłany!');
                
                    
        }
        
        public function activate($id)
        {
            //sprawdzenie czy uzytkownik jest rootem
            if(Auth::user()->id){
                DB::table('users')
                            ->where('id','=',$id)
                            ->update(['confirmed'=>1,
                                'role_id'=>1]);
                    
                    //wyslanie e-mail do uzytkownika o tym ze zostal aktywowany 
                    //i ma sie skontaktowac z administratorem zeby ustalic przyczyne
                    $data['email']=DB::table('users')
                            ->where('id','=',$id)
                            ->select('email')
                            ->pluck('email');
                    $userid=Auth::user()->id;
                    $data['root']=DB::table('users')
                            ->where('id','=',$userid)
                            ->select('email')
                            ->pluck('email');
                
                    Mail::send('emails.activation', $data ,function($message) use ($data){
                    $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Aktywacja w CRM mietech.pl');
                    $message->to($data['email']);
                    }
                    );
                
                
                //wyswietlenie powiadomienia o aktywacji uzytkownika
                     \Session::flash('success','Użytkownik aktywowany. Został o tym poinformowany!');
            
                    return view('admin.admin')->with('success','Użytkownik aktywowany. Został o tym poinformowany!');
                
                
            }
            else {
                abort(404, 'Nie masz odpowiednich uprawnień.');
            }
        }
        
        public function deactivate($id)
        {
            //sprawdzenie czy uzytkownik jest rootem
            if(Auth::user()->admin==1){
                //sprawdzenie czy uzytkownik sam nie jest administratorem - sam nie moze sie dezaktywowac
                if(Auth::user()->id==$id){
                    
                //wyswietlenie powiadomienia o niemożności dezaktywacji samego siebie
                \Session::flash('danger','Nie możesz dezaktywować sam siebie!');
            
                return view('admin.admin')->with('danger','Nie możesz dezaktywować sam siebie!');
                }
                else {
                    DB::table('users')
                            ->where('id','=',$id)
                            ->update(['confirmed'=>0]);
                    
                    //wyslanie e-mail do uzytkownika o tym ze zostal dezaktywowany 
                    //i ma sie skontaktowac z administratorem zeby ustalic przyczyne
                    $data['email']=DB::table('users')
                            ->where('id','=',$id)
                            ->select('email')
                            ->pluck('email');
                    $userid=Auth::user()->id;
                    $data['root']=DB::table('users')
                            ->where('id','=',$userid)
                            ->select('email')
                            ->pluck('email');
                
                    Mail::send('emails.deactivation', $data ,function($message) use ($data){
                    $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Dezaktywacja w CRM mietech.pl');
                    $message->to($data['email']);
                    }
                    );
                    
                    //wyswietlenie powiadomienia o niemożności dezaktywacji samego siebie
                     \Session::flash('success','Użytkownik dezaktywowany. Został o tym poinformowany!');
            
                    return view('admin.admin')->with('success','Użytkownik dezaktywowany. Został o tym poinformowany!');
                }
            }
            else {
                abort(404, 'Nie masz odpowiednich uprawnień.');
            }
            
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
        
        public function updateResTo(){
            //AdminController::create($request->all());
            foreach($_POST as $key=>$value)
            {
                $res_name=$value;
                $id_res=DB::table('resources')
                        ->where('name','=',$res_name)
                        ->pluck('id');
                $id_user=$key;
                
                DB::table('resources_assignment')
                        ->where('id_user','=',$id_user)
                        ->update(['id_res'=>$id_res]);
            }
                 \Session::flash('success','Zasoby zaktualizowane!');
            
                    return view('admin.admin')->with('success','Zasoby zaktualizowane!');
            
        }
        
        public function updateTeamTo(){
            //AdminController::create($request->all());
            foreach($_POST as $key=>$value)
            {
                $team_name=$value;
                $id_team=DB::table('teams')
                        ->where('name','=',$team_name)
                        ->pluck('id');
                $id_user=$key;
                
                DB::table('teams_assignment')
                        ->where('id_user','=',$id_user)
                        ->update(['id_team'=>$id_team]);
            }
//                
                        //wyswietlenie powiadomienia o niemożności dezaktywacji samego siebie
                     \Session::flash('success','Zespoły zaktualizowane!');
            
                    return view('admin.admin')->with('success','Zespoły zaktualizowane!');
                
            
        }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete($id){
            //sprawdzenie czy uzytkownik jest rootem
            if(Auth::user()->id){
                //sprawdzenie czy uzytkownik sam nie jest administratorem - sam nie moze sie usunac
                if(Auth::user()->id==$id){
                    
                //wyswietlenie powiadomienia o niemożności dezaktywacji samego siebie
                \Session::flash('danger','Jako administrator nie możesz usunąć swojego konta!');
            
                return view('admin.admin')->with('danger','Jako administrator nie możesz usunąć swojego konta!');
                }
                else {
                    
                    //wyslanie e-mail do uzytkownika o tym ze zostal usuniety 
                    //i ma sie skontaktowac z administratorem zeby ustalic przyczyne
                    $data['email']=DB::table('users')
                            ->where('id','=',$id)
                            ->select('email')
                            ->pluck('email');
                    $userid=Auth::user()->id;
                    $data['root']=DB::table('users')
                            ->where('id','=',$userid)
                            ->select('email')
                            ->pluck('email');
                
                    Mail::send('emails.delete', $data ,function($message) use ($data){
                    $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Usunięto konto w CRM mietech.pl');
                    $message->to($data['email']);
                    }
                    );
                    DB::table('users')
                            ->where('id','=',$id)
                            ->delete();
                
                //wyswietlenie powiadomienia o aktywacji uzytkownika
                     \Session::flash('success','Użytkownik usunięty! Został o tym poinformowany!');
            
                    return view('admin.admin')->with('success','Użytkownik usunięty! Został o tym poinformowany!');
                }
                
            }
            else {
                abort(404, 'Nie masz odpowiednich uprawnień.');
            }
        }
        
}
