<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Zadania;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class ToDoListController extends Controller {

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
        
        public function tasksCreateShow()
        {
            return view('zadania.todolist.dodaj');
        }
        
        
        public function todolistShow()
        {
            $userid=Auth::user()->id;
            $tasks=DB::table('tasks')
                    ->join('users','users.id','=','tasks.id_user')
                    ->select('users.id as id_user','tasks.id as id_task','tasks.comment as comment')
                    ->where('id_user','=',$userid)
                    ->orderBy('id_task','asc')
                    ->get();
            return view('zadania.todolist.przeglad')
                    ->with('tasks',$tasks);
        }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        }
        
        public function createNew(Requests\CreateTaskRequest $request)
        {   
            ToDoListController::tasksCreateShow($request->all());
            
            $iduser=Auth::user()->id;
            $comment=$_POST['comment'];
            
            
            DB::table('tasks')->insert(['id_user'=>$iduser,
                'comment'=>$comment]);
            
            //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('success','Dodano nowe zadanie!');
            
            return view('zadania.todolist')->with('success','Dodano nowe zadanie!');
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
            $taskid=$id;
            $userid=Auth::user()->id;
            $taskuserid=DB::table('tasks')
                    ->where('tasks.id','=',$taskid)
                    ->pluck('tasks.id_user');
            //sprawdzenie czy komenda zakonczenia zadania pochodzi od jego wlasciciela
            if($taskuserid===$userid){
                
                DB::table('tasks')
                        ->where('tasks.id','=',$taskid)
                        ->delete();
                
                //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('success','Zadanie zakończone!');
            
            return view('zadania.todolist')->with('success','Zadanie zakończone!');
            }
            else {
                //wyswietlenie powiadomienia o stworzeniu nowej osoby
            \Session::flash('danger','Coś poszło nie tak');
            
            return view('zadania.todolist')->with('danger','Coś poszło nie tak');
            }
            
            
            
	}
        
        //generowanie widoku dla usuwania pozycji
        public function delete(){
        }
        
}
