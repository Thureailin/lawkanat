<?php

namespace App\Http\Controllers\Api;

use App\Code;
use App\Meal;
use App\User;
use Datetime;
use App\Order;
use App\Option;
use App\MenuItem;
use App\CuisineType;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OptionResource;
use App\Http\Resources\MenuItemResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\CuisineTypeResource;

class CustomerController extends ApiBaseController
{
    protected function today()
	{
		$now = new DateTime;

		$today = strtotime($now->format('d-m-Y H:i'));

		return $today;
	}

	protected function editProfile(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'address' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$user = User::find($request->user()->id);

		if ($request->hasfile('photo')) {

			$image = $request->file('photo');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() . '/photo/User/', $photo_path);
		}
		else{

			$photo_path =  $user->photo_path;

		}

		$user->name = $request->name;

		$user->email = $request->email;

		$user->photo_path = $photo_path;

		$user->phone = $request->phone;

		$user->address = $request->address;

		$user->save();

		$user->photo_path = url("/") . '/photo/User/' . $user->photo_path;

		return $this->sendSuccessResponse("user", $user);
	}

	protected function getMealList()
	{
		$meal_lists = Meal::all();

		return $this->sendSuccessResponse("meal_lists", $meal_lists);
	}

	protected function getCodeList()
	{
		$code_lists = Code::all();

		return $this->sendSuccessResponse("code_lists", $code_lists);
	}

	protected function getCuisineTypeList(Request $request)
    {
   		$validator = Validator::make($request->all(), [
			'meal_id' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$cuisine_lists = CuisineType::where('meal_id', $request->meal_id)->get();

		$final_cuisine_lists= CuisineTypeResource::collection($cuisine_lists);

		return $this->sendSuccessResponse("cuisine_lists", $final_cuisine_lists);
    }

    protected function getMenuItemList(Request $request)
    {
    	$validator = Validator::make($request->all(), [
			'cuisine_type_id' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$menu_item_lists = MenuItem::where('cuisine_type_id', $request->cuisine_type_id)->where('customer_console',0)->whereNull('deleted_at')->get();

		$final_menu_item_lists= MenuItemResource::collection($menu_item_lists);

		return $this->sendSuccessResponse("menu_item_lists", $final_menu_item_lists);
    }

    protected function getOptionList(Request $request)
    {
    	$validator = Validator::make($request->all(), [
			'menu_item_id' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$option_lists = Option::where('menu_item_id', $request->menu_item_id)->whereNull("deleted_at")->get();

		$fianl_option_lists = OptionResource::collection($option_lists);

		return $this->sendSuccessResponse("option_lists", $fianl_option_lists);
    }

    protected function storeOrder(Request $request)
    {

    	$today = $this->today();

    	$validator = Validator::make($request->all(), [
			'address' => 'required',
			'phone' => 'required',
			'name' => 'required',
			'total_qty' => 'required',
			'order_date' => 'required|after_or_equal:today',
			'note' => 'required',
			'option_lists' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$user = User::find($request->user()->id);

		$order_format_date = date('Y-m-d H:i', strtotime($request->order_date));

		$option_lists = json_decode(json_encode($request->option_lists));

		$options = Option::all();

		$check_qty = 0;

		$price = 0;

		foreach ($option_lists as $option) {

			foreach ($options as $opt) {

				if ($option->option_id == $opt->id) {

					$price += $option->qty * $opt->sale_price;
				}
			}
		}

		foreach ($option_lists as $option) {

			$check_qty += $option->qty;
		}

		if ($check_qty != $request->total_qty) {

			return $this->sendFailResponse("Something Wrong! Not equal amount.", "400");
		}
		else{

			try {

				$order = Order::create([
	                'address' => $request->address,
	                'name' => $request->name,
	                'phone' => $request->phone,
	                'total_quantity' => $request->total_qty,
	                'price' => $price,
	                'order_date' => $order_format_date,
	                'note' => $request->note,
	                'customer_id' => $user->id,
	                'status' => 1, 										// Order Status = 1
	            ]);

	            $order->order_number = "ORD-".sprintf("%04s", $order->id);

	            $order->save();

	            foreach ($option_lists as $option) {

					$order->option()->attach($option->option_id, ['quantity' => $option->qty]);
				}

				return $this->sendSuccessResponse("order", $order);

			} catch (\Exception $e) {

           		return $this->sendFailResponse("Something Wrong! When store Order.", "422");

        	}
		}
    }

    protected function storeOrderWithDelivery(Request $request)
    {

    	$today = $this->today();

    	$validator = Validator::make($request->all(), [
			'address' => 'required',
			'phone' => 'required',
			'name' => 'required',
			'total_qty' => 'required',
			'order_date' => 'required|after_or_equal:today',
			'note' => 'required',
			'delivery_charges' => 'required',
			'option_lists' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		$user = User::find($request->user()->id);

		$order_format_date = date('Y-m-d H:i', strtotime($request->order_date));

		$option_lists = json_decode(json_encode($request->option_lists));

		$options = Option::all();

		$check_qty = 0;

		$price = 0;

		foreach ($option_lists as $option) {

			foreach ($options as $opt) {

				if ($option->option_id == $opt->id) {

					$price += $option->qty * $opt->sale_price;
				}
			}
		}

		foreach ($option_lists as $option) {

			$check_qty += $option->qty;
		}

		if ($check_qty != $request->total_qty) {

			return $this->sendFailResponse("Something Wrong! Not equal amount.", "400");
		}
		else{

			try {

				$order = Order::create([
	                'address' => $request->address,
	                'name' => $request->name,
	                'phone' => $request->phone,
	                'total_quantity' => $request->total_qty,
	                'price' => $price,
	                'order_date' => $order_format_date,
	                'note' => $request->note,
	                'delivery_charges' => $request->delivery_charges,
	                'customer_id' => $user->id,
	                'status' => 1, 										// Order Status = 1
	            ]);

	            $order->order_number = "ORD-".sprintf("%04s", $order->id);

	            $order->save();

	            foreach ($option_lists as $option) {

					$order->option()->attach($option->option_id, ['quantity' => $option->qty]);
				}

				return $this->sendSuccessResponse("order", $order);

			} catch (\Exception $e) {

           		return $this->sendFailResponse("Something Wrong! When store Order.", "422");

        	}
		}
    }

    protected function getOrderList(Request $request)
    {
    	$user = User::find($request->user()->id);

    	$order_lists = Order::where('customer_id', $user->id)->orderBy('id', 'desc')->get();

    	$final_orders = OrderResource::collection($order_lists);

    	return $this->sendSuccessResponse("order_lists", $final_orders);
    }

    protected function getOrderDetails(Request $request)
    {
    	$validator = Validator::make($request->all(), [
			'order_id' => 'required',
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$order = Order::findOrFail($request->order_id);

   		} catch (\Exception $e) {

        	return $this->sendFailResponse("Something Wrong! Order Cannot Be found.", "400");

    	}

    	$option_lits = array();

    	foreach($order->option as $option){

    		$option_id = $option->id;

    		$name = $option->name;

    		$menu_item_name = $option->menu_item->item_name;

    		$order_qty = $option->pivot->quantity;

    		if ($option->size == 1) {

    			$size = "Small";

    		} elseif ($option->size == 2) {

    			$size = "Normal";

    		}else {
    			$size = "Large" ;
    		}


    		$collection = collect(['option_id','name', 'menu_item_name','size','qty']);

			$combined = $collection->combine([$option_id,$name,$menu_item_name,$size,$order_qty]);

    		array_push($option_lits, $combined);

    	}

    	$order_response = Order::where('id',$request->order_id)->get();

    	$final_orders = OrderResource::collection($order_response);

    	return response()->json([
    		"message" => "Successful",
    		"status" => 200,
    		"order" => $final_orders,
    		"option_lists" => $option_lits,
    	]);
    }

    protected function acceptOrder(Request $request)
    {
    	$today = $this->today();

    	$validator = Validator::make($request->all(), [
			'order_id' => 'required',
			'remark' => 'required'
		]);

		if ($validator->fails()) {

			return $this->sendFailResponse("Something Wrong! Validation Error.", "400");
		}

		try {

			$order = Order::findOrFail($request->order_id);

   		} catch (\Exception $e) {

        	return $this->sendFailResponse("Something Wrong! Order Cannot Be found.", "400");

    	}

    	if ($order->status != 3 ) {

    		return $this->sendFailResponse("Something Wrong! This Order is Not Delivered!.", "400");

    	} else {

    		$accept_date = date('Y-m-d H:i', $today);

    		$order->accepted_date = $accept_date;

			$order->status = 4;

			$order->remark = $request->remark;

			$order->save();

			return $this->sendSuccessResponse("order", $order);

    	}
    }
}
