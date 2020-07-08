<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \App\VCode;

class CodeController extends Controller
{
    public function store(Request $r)
    {
		ini_set('max_execution_time', 300 );
		$message = '';
		$code = 400;
		$data = [];
		
		if($r->codes){
			$codes = explode(',',$r->codes);
            foreach ($codes as $code) {
                $data[] = [
                    'unique_code' => $code,
                    'created_at' => Carbon::now()
                ];
            }
		}
		if(count($data) > 0){
			$insert_data = collect($data);
			
			$chunks = $insert_data->chunk(10000);
			foreach ($chunks as $chunk)
			{
			   VCode::insert($chunk->toArray());
			}
			
			$message = 'codes generate successfully';
			$code = 200;
		}else{
			$message = 'data not found';
		}
		
		return response("{'message':{$message}}", $code)
        ->header('Content-Type', 'application/json');
    }
}