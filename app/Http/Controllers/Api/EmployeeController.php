<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderNoti;
use App\ShopOrder;
use App\Table;
use App\TableType;
use App\Voucher;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\ShopOrderResource;
use App\Http\Resources\KitchenResource;
use App\Http\Resources\VoucherResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datetime;
use Illuminate\Support\Facades\Log;

class EmployeeController extends ApiBaseController
{
	protected function getTableTypeList()
	{
		$table_type_lists = TableType::all();

		return $this->sendSuccessResponse("table_type_lists", $table_type_lists);
	}

	protected function getTableList(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'table_type_id' => 'required',
			'floor' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$table_lists = Table::where('table_type_id', $request->table_type_id)->where('floor', $request->floor)->get();

		return $this->sendSuccessResponse("table_lists", $table_lists);
	}

	protected function storeShopOrder(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'table_id' => 'required',
			'option_lists' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$option_lists = json_decode(json_encode($request->option_lists));

		try {

				$table = Table::findOrFail($request->table_id);

				if ($table->status == 2) {

					return $this->sendFailResponse("Something Wrong! Table is not available.", "400");

				} else {
					
					$table->status = 2;

					$table->save();

					$order = ShopOrder::create([
		                'table_id' => $request->table_id,
		                'status' => 1,                     // Order Status = 1
		                'type' => 1,
		            ]);

		            $order->order_number = "ORD-".sprintf("%04s", $order->id);

		            $order->save();

		            foreach ($option_lists as $option) {
					
						$order->option()->attach($option->option_id, ['quantity' => $option->qty,'note' => $option->note,'status' => 0]);
					}
					
				//	event(new OrderNoti( $order->id,0));
					//status 0 = storeshoporder  1- addmoreitem  2- storevoucher
					return $this->sendSuccessResponse("order", $order);
				}	            
            
    		} catch (\Exception $e) {
        
      			return $this->sendFailResponse("Something Wrong! When store Order.", "422");
      		}
	}

	protected function getShopOrderPendingList(Request $request)
	{
		$order_lists = ShopOrder::where('status', 1)->get();

		$final_order_lists = array();

		foreach($order_lists as $order){
		    
		    $type = 0;

			$total_qty = 0 ;

			$total_price = 0 ;

			if ($order->status == 1) {
    			
    			$size = "Pending";

    		} 
    		else{

    			$size = "Finished";
    		}

    		if ($order->table_id == 0) {
    			
    			$table_number = "Take Away";

    		} 
    		else{

    			$table_number = $order->table->table_number;
    		}
    		
    		$type = $order->type;

    		foreach ($order->option as $option) {
    			
    			$total_qty += $option->pivot->quantity;

    			$total_price += $option->sale_price * $option->pivot->quantity;
    		}
    		
    		

			$collection = collect(['order_id','order_number','status','table_id','table_number','total_qty','total_price','type']);
			$combined = $collection->combine([$order->id,$order->order_number,$size,$order->table_id,$table_number,$total_qty,$total_price,$type]);

    		array_push($final_order_lists, $combined);
		}

		return $this->sendSuccessResponse("order", $final_order_lists);
	}

	protected function getShopOrderFinishedList(Request $request)
	{
		$order_lists = ShopOrder::where('status', 2)->get();

		$final_order_lists = array();

		foreach($order_lists as $order){

			$total_qty = 0 ;

			$total_price = 0 ;

			if ($order->status == 1) {
    			
    			$size = "Pending";

    		} 
    		else{

    			$size = "Finished";
    		}

    		foreach ($order->option as $option) {
    			
    			$total_qty += $option->pivot->quantity;

    			$total_price += $option->sale_price * $option->pivot->quantity;
    		}

			$collection = collect(['order_id','order_number','status','table_id','table_number','total_qty','total_price']);

			$combined = $collection->combine([$order->id,$order->order_number,$size,$order->table_id,$order->table->table_number,$total_qty,$total_price]);

    		array_push($final_order_lists, $combined);
		}

		return $this->sendSuccessResponse("order", $order_lists);
	}

	protected function getShopOrderDetails(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'order_id' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$shop_order_details = ShopOrder::findOrFail($request->order_id);
			
		} catch (\Exception $e) {
			
			return $this->sendFailResponse("Something Wrong! Shop Order Cannot be Found.", "422");

		}

		$order_response = ShopOrder::where('id',$shop_order_details->id)->get();

		$final_shop_order_details = ShopOrderResource::collection($order_response);

		return $this->sendSuccessResponse("shop_order_details", $final_shop_order_details);
	}

	protected function addMoreItem(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'order_id' => 'required',
			'option_lists' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$option_lists = json_decode(json_encode($request->option_lists));


		try {

			$shop_order = ShopOrder::findOrFail($request->order_id);

		} catch (\Exception $e) {
			
			return $this->sendFailResponse("Something Wrong! Shop Order Cannot be Found.", "422");
		}	

		if ($shop_order->status == 1) {

			foreach ($option_lists as $option) {

				$test = $shop_order->option()->where('option_id', $option->option_id)->first();

				if (empty($test)) {

					$shop_order->option()->attach($option->option_id, ['quantity' => $option->qty, 'tocook'=>1, 'note' => $option->note, 'status' => 0]);

				} else {
					//$oldQty= $test->pivot->quantity;
					//$update_qty = $option->qty + $oldQty;
					//$newQty = $option->qty;
					//$shop_order->option()->updateExistingPivot($option->option_id, ['quantity' => $update_qty,'tocook'=>1,'add_same_item_status'=>1,'old_quantity'=>$oldQty,'new_quantity'=>$newQty] );
				
				    if($test->pivot->quantity != $option->qty){
				    
				        $update_qty = $option->qty;
				    
				        $newQty = $option->qty - $test->pivot->quantity;
                    
					    $shop_order->option()->updateExistingPivot($option->option_id, ['quantity' => $update_qty,'tocook'=>1,'add_same_item_status'=>1,'old_quantity'=>$test->pivot->quantity,'new_quantity'=>$newQty] );
				    }    

				    
				}
			}	
			$shop_order->type=1;
			$shop_order->save();
        	//event(new OrderNoti( $shop_order->id,1));
        	
            // Log::info(json_encode($shop_order));
			return $this->sendSuccessResponse("order", $shop_order);

		} else {
			
			return $this->sendFailResponse("Something Wrong! This Order is Closed.", "422");
		}
	}

	protected function storeVoucher(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'shop_order_id' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$shop_order = ShopOrder::where('id',$request->shop_order_id)->where('status','1')->first();
			
			if(empty($shop_order)){

				return $this->sendFailResponse("Cannot Checkbill again!.", "422");
	
			}
			
			$table = Table::findOrFail($shop_order->table_id);
			
		} catch (\Exception $e) {
			
			return $this->sendFailResponse("Something Wrong! Shop Order Cannot be Found.", "422");

		}

		$user_id = $request->user()->id;

		
		$total = 0 ;

		$total_qty = 0 ;

		$now = new DateTime('Asia/Yangon');

		$today = $now->format('Y-m-d h:m:s');

		foreach ($shop_order->option as $option) {

            $total += ($option->pivot->quantity * $option->sale_price);

            $total_qty += $option->pivot->quantity;
        }

        $voucher = Voucher::create([
            'sale_by' => $user_id,
            'total_price' =>  $total,
            'total_quantity' => $total_qty,
            'voucher_date' => $today,
            'type' => 1,
            'status' => 0,
        ]);

    	$voucher->voucher_code = "VOU-".date('dmY')."-".sprintf("%04s", $voucher->id);

        $voucher->save();

     	foreach ($shop_order->option as $option) {

        	$voucher->option()->attach($option->id, ['quantity' => $option->pivot->quantity,'price' => $option->sale_price]);
    	} 

    	$shop_order->voucher_id = $voucher->id;

    	$shop_order->status = 2;

    	$shop_order->save();

    	$table->status = 1;

    	$table->save();
	//	event(new OrderNoti( $shop_order->voucher_id,2));
    	return $this->sendSuccessResponse("voucher", $voucher);
	}

	protected function getVoucherList(Request $request)
	{
		$now = new DateTime;

        $today = strtotime($now->format('d-m-Y'));

		$validator = Validator::make($request->all(), [
			'start_date' => 'required|before_or_equal:today',
			'end_date' => 'required|after:start_date',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$start_date = $request->start_date;

		$end_date = $request->end_date;

		$voucher_lists = Voucher::whereBetween('voucher_date', [$start_date, $end_date])->where('type', 1)->get();

		$final_voucher_lists = VoucherResource::collection($voucher_lists);

		return $this->sendSuccessResponse("voucher_lists", $final_voucher_lists);
	}

	protected function getKitchenOrderList(Request $request)
	{
		$order_lists = ShopOrder::where('status', 1)->get();

		$final_order_lists = KitchenResource::collection($order_lists);

		return $this->sendSuccessResponse("kitchen_order", $final_order_lists);
	}

	protected function changeCookingStatus(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'order_id' => 'required',
			'option_id' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$shop_order = ShopOrder::findOrFail($request->order_id);

		} catch (\Exception $e) {
			
			return $this->sendFailResponse("Something Wrong! Shop Order Cannot be Found.", "422");
		}	

		$shop_order->option()->updateExistingPivot($request->option_id, ['status' => 1] );

		return $this->sendSuccessResponse("order", $shop_order);
	}

	protected function changeFinishedStatus(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'order_id' => 'required',
			'option_id' => 'required',
		]);

		if ($validator->fails()) {			

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$shop_order = ShopOrder::findOrFail($request->order_id);

		} catch (\Exception $e) {
			
			return $this->sendFailResponse("Something Wrong! Shop Order Cannot be Found.", "422");
		}	

		$shop_order->option()->updateExistingPivot($request->option_id, ['status' => 2] );

		return $this->sendSuccessResponse("order", $shop_order);
	}
	
	protected function changeOrderType(Request $request){
	    $validator = Validator::make($request->all(),[
	        'order_id' => 'required',
	   ]);
	   
	   if($validator->fails()){
	       return $this->sendFailResponse("Something Wrong! Validation Error.","400");
	   }
	   
	   try{
	       $shop_order = ShopOrder::findOrFail($request->order_id);
	   }catch(\Exception $e){
	       return $this->sendFailResponse("Something Wrong! Shop Order cannot be found.","422");
	   }
	   
	   $shop_order->type = 0;
	   $shop_order->save();
	   
	   return $this->sendSuccessResponse("order",$shop_order);
	   
	}

}
