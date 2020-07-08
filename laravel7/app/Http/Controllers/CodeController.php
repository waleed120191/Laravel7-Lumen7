<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('code/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$codes = '';
		for($i=0;$i<=$request->quantity;$i++){
			$codes .= Str::random(7) . ',';
		}
		
		$codes = rtrim($codes, ",");
		
		$status = 400;
		$response = "";
		try{
			$client = new Client();
			$response = $client->post(
				'http://localhost:8001/codes',
				[
					\GuzzleHttp\RequestOptions::JSON => 
					['codes' => $codes],
					'http_errors' => false
				],
				['Content-Type' => 'application/json']
			);
			$status = $response->getStatusCode();
		}catch(\Exception $e){
			//echo 'Message: ' .$e->getMessage();
			$status = 400;
		}finally{
			return response("{\"status\":\"{$status}\"}", 200)->header('Content-Type', 'application/json');
		}
		
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
