<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Http\Request;
use PDF;
use App;
use DB;

class TestPDFController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $nr_oferty = '17326';
            $products = DB::table('products')
                    ->join('currencies', 'currencies.id', '=', 'products.currency')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->select('products.name','categories.category','products.price','currencies.currency')
                    ->get();
            $pdf= PDF::loadView('test.test3', array('nr_oferty' => $nr_oferty,
                'products' => $products));
            return $pdf->download('test.pdf');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
