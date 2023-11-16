<?php

namespace App\Http\Controllers\Web;

use App\Town;
use App\User;
use DateTime;
use App\Order;
use App\Option;
use App\Voucher;
use App\Township;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected function getOrderPanel(){

    	return view('Order.order_panel');
    }

    protected function getOrderPage($type){

    	$order_lists = Order::where('status',$type)->orderBy('id', 'desc')->get();

    	$employee_lists = User::where('role_flag' , 2)->get();

    	return view('Order.order_page', compact('order_lists','type','employee_lists'));
    }

    protected function getOrderDetailsPage($id){

        try {

            $order = Order::findOrFail($id);

        } catch (\Exception $e) {

            alert()->error("Order Not Found!")->persistent("Close!");

            return redirect()->back();
        }

        return view('Order.order_details', compact('order'));
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
    protected function storedelivery(Request $request){
        // dd($request->all());

        // $option_list = $request->option_lists;
        // dd($option_list);

            // $today = $this->today();

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

                alert()->error('Something Wrong! Validation Error!');

                return redirect()->back();
            }

            // $user = User::find($request->user()->id);

            $order_format_date = date('Y-m-d H:i', strtotime($request->order_date));

            $option_lists = json_decode($request->option_lists);
            // dd($option_lists);
            $options = Option::all();

            $check_qty = 0;

            $price = 0;

            $sale_by = session()->get('user')->name;
        // dd($sale_by);

            $type="2";
            $employee_lists = User::where('role_flag' , 2)->get();

            $town = Town::find($request->township);
            // dd($town->town_name);

            foreach ($option_lists as $option) {
                    //  dd($option);
                foreach ($options as $opt) {

                    if ($option->id == $opt->id) {

                        $price += $option->order_qty * $opt->sale_price;
                    }
                }
            }
            // dd($price);
            foreach ($option_lists as $option) {

                $check_qty += $option->order_qty;
            }
            // dd($check_qty);
            if ($check_qty != $request->total_qty) {

                return $this->sendFailResponse("Something Wrong! Not equal amount.", "400");
            }
            else{

                try{

                    $order = Order::create([
                        'address' => $request->address,
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'total_quantity' => $request->total_qty,
                        'price' => $price,
                        'order_date' => $order_format_date,
                        'note' => $request->note,
                        'customer_id' => 0,
                        'status' => 2,
                        'delivery_charges' => $request->deli_charges,
                		'township' => $town->town_name,
                        'sale_by' => $sale_by							// Order Status = 1
                    ]);

                    $order->order_number = "ORD-".sprintf("%04s", $order->id);

                    $order->save();

                    $order_lists = Order::where('status',$type)->orderBy('id', 'desc')->get();
                    foreach ($option_lists as $option) {

                        $order->option()->attach($option->id, ['quantity' => $option->order_qty]);
                    }


                    $deliver_order = Order::find($order->id);
                    // dd($deliver_order);
                    //Begin


                    $alloption = Option::all();
                    $option_name = DB::table('option_order')
                    ->where('order_id',$deliver_order->id)

                    ->get();
                    $name = [];
                    foreach($option_name as $optionss)
                    {
                    $oname = Option::find($optionss->option_id);
                    array_push($name,$oname);
                    }

                    $fromadd = 3;
                    $tablenoo = 1;
                    $date = new DateTime('Asia/Yangon');

                    $real_date = $date->format('d-m-Y h:i:s');

                    $code_lists = json_decode($request->code_lists);
                    $notte = [];
                    if($code_lists != null){
                    foreach($code_lists as $code){
                        $remark_note = DB::table('option_order')
                                        ->where('option_id',$code->id)
                                        ->update(['note' => $code->remark]);
                        $note_remark = DB::table('option_order')
                                        ->where('option_id',$code->id)
                                        ->first();
                            array_push($notte,$note_remark);
                    }
                    }
                    // dd($notte);
                    // dd('hey');
                    return view('Sale.kitchen_lists',compact('option_name','notte','real_date','name','fromadd','tablenoo','deliver_order'));
                    //end

                    // return view('Order.order_page',compact('type','order_lists','employee_lists'));

                } catch (\Exception $e) {

                    alert()->error("Something wrong Baby!")->persistent("Close!");

                    return redirect()->back();

                }
            }

    }

    protected function changeOrderStatus(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {

            alert()->error('Something Wrong! Validation Error!');

            return redirect()->back();
        }

        $user = session()->get('user');

        // dd($user->id);
    	try {

        	$order = Order::findOrFail($request->order_id);

   		} catch (\Exception $e) {

        	alert()->error("Order Not Found!")->persistent("Close!");

            return redirect()->back();
    	}

        if ($order->status == 1 ) {

            $order->status = 2;

            $order->save();

            alert()->success('Successfully Changed');

            return redirect()->back();

        }elseif ($order->status == 2 ) {

            if (is_null($request->delivered_date) && is_null($request->employee)) {

                // dd("error");
                alert()->error("Something Wrong! Delivered Date and Delivery Person Can't be Empty!")->persistent("Close!");

                return redirect()->back();
            }
            else{

                $total = 0;

                $order->status = 3;

                $order->employee_id = $request->employee;

                $order->delivered_date = $request->delivered_date;

                $order->save();

                foreach ($order->option as $option) {

                    $total += ($option->pivot->quantity * $option->sale_price);
                }

                // dd($id);
                $voucher = Voucher::create([
                    'sale_by' => $user->id,
                    'total_price' =>  $total,
                    'total_quantity' => $order->total_quantity,
                    'voucher_date' => $request->delivered_date,
                    'type' => 2,
                    'status' => 0,
                ]);

                $voucher->voucher_code = "VOU-".date('dmY')."-".sprintf("%04s", $voucher->id);

                $voucher->save();
                foreach ($order->option as $optionaa) {
                    $voucher->option()->attach($optionaa->id, ['quantity' => $optionaa->pivot->quantity,'price' => $optionaa->sale_price]);

                }

                foreach ($order->option as $opt) {



                    $moption = Option::findorFail($opt->id);
                    // dd($moption);

                    $amount = DB::table('ingredient_option')
                    ->select('amount')
                    ->where('option_id',$moption->id)
                    ->first();
                    if($amount != null){
                    foreach($amount as $amt)
                    // dd($amt);
                    $amountt = $amt;
                    $ingredien = DB::table('ingredient_option')
                    ->select('ingredient_id')
                    ->where('option_id',$moption->id)
                    ->first();
                    //   dd($ingredien);

                     foreach($ingredien as $ingred)

                     $ingreID = $ingred;
                    $ingredient_update = Ingredient::findorFail($ingreID);

                        $balance_qty = $ingredient_update->instock_quantity - $amountt;
                        $ingredient_update->instock_quantity = $balance_qty;
                        $ingredient_update->save();
                    }
                    else{
                        alert()->success('Successfully Changed');

                        return view('Order.order_voucher', compact('voucher','order'));
                    }


                }


                // dd("hello");
                alert()->success('Successfully Changed');

                return view('Order.order_voucher', compact('voucher','order'));

            }


        }
        else{

            alert()->error('Something Wrong! Order is Delivered!');

            return redirect()->back();

        }


    }
}
