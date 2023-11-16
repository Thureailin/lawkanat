<?php

namespace App\Http\Controllers\Api;

use App\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function rating(Request $request)
    {
        //type for 0=shop,1= delivery,
        //'customer_id','table_id','voucher_id','employee_id','star','feedback','type'
        $type=$request->type;
        if ($type==0){
            $validator = Validator::make($request->all(), [

                'voucher_id' => 'required',
                'employee_id'=>'required',
                'star'=>'required|max:5',
                'feedback'=>'required',
                'table_id'=>'required'
            ]);
    
            if ($validator->fails()) {			
    
                return response()->json([
                    'status'=>0,
                    'message'=>$validator->errors()
                ]);
            }


        }
        else if($type==1){
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required',
                'voucher_id' => 'required',
                'star'=>'required',
                'feedback'=>'required',
                'employee_id'=>'required',
            ]);
    
            if ($validator->fails()) {			
    
                return response()->json([
                    'status'=>0,
                    'message'=>$validator->errors()
                ]);
            }
        }

        $rating=Rating::create([
            'customer_id'=>$request->customer_id,
            'table_id'=>$request->table_id,
            'employee_id'=>$request->employee_id,
            'star'=>$request->star,
            'feedback'=>$request->feedback,
            'voucher_id'=>$request->voucher_id,
            'type'=>$request->type,

        ]);

        return response()->json([
            'status'=>1,
            'message'=>$rating,
        ]);

    }

    public function deliveryRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id'=>'required',
            'star'=>'required|max:5',
            'feedback'=>'required',
            'customer_id'=>'required'
        ]);

        if ($validator->fails()) {			

            return response()->json([
                'status'=>0,
                'message'=>$validator->errors()
            ]);
    }

    $rating=Rating::create([
        'customer_id'=>$request->customer_id,
        'employee_id'=>$request->employee_id,
        'star'=>$request->star,
        'feedback'=>$request->feedback,
        'type'=>$request->type,
        'voucher_id'=>$request->voucher_id,

    ]);

    return response()->json([
        'status'=>1,
        'message'=>$rating,
    ]);
}
}
