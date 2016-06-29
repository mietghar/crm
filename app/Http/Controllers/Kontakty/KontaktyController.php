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
            $companies = DB::table('companies')->get();
            
            return view('kontakty.firmy')->with('companies',$companies);
        }
        
        public function personsShow()
        {
            $persons = DB::table('persons')->get();
            
            return view('kontakty.osoby')->with('persons',$persons);
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
