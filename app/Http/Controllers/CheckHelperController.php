<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CheckHelperController extends Controller
{
    public function index()
    {
    	//$converted_amount = convertCurrency(10,'USD','INR');
    	//echo $converted_amount;
    	 return view('checkhelper');
    }

    public function store(Request $request)
    {

 $validator = Validator::make($request->all(), [
        'currancy_amount' => 'required|numeric',
    ]);
 if ($validator->fails()) {
	 return redirect('customhelper')
                        ->withErrors($validator)
                        ->withInput();
}
    	$converted_amount = convertCurrency($request->currancy_amount,'USD',$request->currancy_convert);
    	$currancy_details = array('currancy_amount'=>$request->currancy_amount,'currancy_convert'=>$request->currancy_convert,'converted_amount'=>$converted_amount);
    	 return view('checkhelper', compact('currancy_details'));
    }
}
