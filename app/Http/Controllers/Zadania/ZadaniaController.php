<?php namespace App\Http\Controllers;
namespace App\Http\Controllers\Zadania;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

use Illuminate\Http\Request;

class ZadaniaController extends Controller {

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
            return view('zadania.zadania');
	}
        
        public function meetingsShow()
        {
            
            return view('zadania.spotkania');
        }
        public function teamShow()
        {
            $userid=Auth::user()->id;
            $tasks=DB::table('tasks')
                    ->join('users','users.id','=','tasks.id_user')
                    ->select('users.id as id_user',
                            'users.name as user_name',
                            'users.email as user_email',
                            'tasks.id as id_task',
                            'tasks.comment as comment')
                    ->orderBy('user_name','asc')
                    ->orderBy('id_task','asc')
                    ->get();
            return view('zadania.zespol')
                    ->with('tasks',$tasks);
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
