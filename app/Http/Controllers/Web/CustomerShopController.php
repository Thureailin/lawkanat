<?php

namespace App\Http\Controllers\Web;

use App\Code;
use App\CuisineType;
use App\Http\Controllers\Controller;
use App\Meal;
use App\MenuItem;
use App\Option;
use App\Order;
use App\Promotion;
use App\ShopOrder;
use App\Table;
use App\TableType;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerShopController extends Controller
{
    protected function getSalePage(){

        $table_lists = Table::orderBy('table_type_id', 'ASC')->get();

        $table_types = TableType::all();

        return view('Customer.sale_page', compact('table_lists','table_types'));
    }
    protected function getShopOrderSalePage($table_id){

        $items = MenuItem::all();

        // dd($items);

        $meal_types = Meal::all();

        // dd($meal_types);

        $codes = Code::all();

        $cuisine_types = CuisineType::all();

        if ($table_id == 0) {

            $table_number = 0;

        } else {

            $order = ShopOrder::where('table_id', $table_id)->where('status', 1)->first();

            if(!empty($order)){
                // dd("hello");
                return redirect()->route('pending_order_details',$order->id);

            }else{
                // dd("hello2");
                $table = Table::where('id', $table_id)->first();

                $table_number = $table->id;

            }
        }
        $table = 1;
        $ygn_towns = Town::where('state_id',13)->get();
        return view('Customer.order_sale_page', compact('ygn_towns','codes','items','meal_types','table','cuisine_types','table_number'));
    }
    protected function getPendingShopOrderDetails($order_id){
        $table_number = 0;
        try {

            $pending_order_details = ShopOrder::findOrFail($order_id);
            // dd($pending_order_details->option);
        } catch (\Exception $e) {

            alert()->error("Pending Order Not Found!")->persistent("Close!");

            return redirect()->back();
        }

        $total_qty = 0 ;

        $total_price = 0 ;

        foreach ($pending_order_details->option as $option) {

            $total_qty += $option->pivot->quantity;

            $total_price += $option->sale_price * $option->pivot->quantity;
        }

        return view('customer.pending_order_details', compact('pending_order_details','total_qty','total_price','table_number'));
    }
    protected function storeShopOrder(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'table_id' => 'required',
            'option_lists' => 'required',
        ]);

        if ($validator->fails()) {

            alert()->error('Something Wrong! Validation Error.');

            return redirect()->back();
        }
        $user_name =  session()->get('user')->name;
        //  dd($user_name);
        $take_away = $request->take_away;
        $option_lists = json_decode($request->option_lists);
        // $agent = new \Jenssegers\Agent\Agent;
        // $is_mobile = $agent->isMobile();
        // $is_desktop = $agent->isDesktop();
        try {
            // dd($is_mobile,$is_desktop);
            $table = Table::where('id', $request->table_id)->first();
// dd($table);
            if (empty($table)) {
                // if($is_desktop == true || $is_mobile == true){
                $order = ShopOrder::create([
                    'table_id' => $request->table_id,
                    'status' => 1,
                    'is_mobile'=> 1,
                    'take_away_flag'=>$take_away,
                    'sale_by' =>$user_name,										// Order Status = 1
                ]);
                // }
                $order->order_number = "ORD-".sprintf("%04s", $order->id);

                $order->save();

                foreach ($option_lists as $option) {

                    $order->option()->attach($option->id, ['quantity' => $option->order_qty,'note' => null,'status' => 7]);
                }

            } else {

                if ($table->status == 2) {

                    alert()->error('Something Wrong! Table is not available.');

                    return redirect()->back();

                } else {

                    $table->status = 2;

                    $table->save();
                    // if($is_desktop == true || $is_mobile == true){
                    $order = ShopOrder::create([
                        'table_id' => $request->table_id,
                        'status' => 1, 										// Order Status = 1
                        'type' => 1,
                        'is_mobile'=> 1,
                        'take_away_flag'=>$take_away,
                        'sale_by' =>$user_name,
                    ]);
                    // }
                    $order->order_number = "ORD-".sprintf("%04s", $order->id);

                    $order->save();

                    foreach ($option_lists as $option) {

                        $order->option()->attach($option->id, ['quantity' => $option->order_qty,'note' => null,'status' => 7]);
                    }
                }
            }

        } catch (Exception $e) {

            alert()->error("Something Wrong! When Store Shop Order");

            return redirect()->back();
        }

        alert()->success('Successfully Store Shop Order');
        //   $allow_print = true;
        $orders = ShopOrder::find($order->id);
        // dd($orders->option()->price);
        $tableno = Table::find($orders->table_id);
        $alloption = Option::all();
        $option_name = DB::table('option_shop_order')
            ->where('shop_order_id',$orders->id)
            ->get();
        // dd($option_name);
        $name = [];
        // $qty = [];
        foreach($option_name as $optionss)
        {
            // dd($optionss->option_id);
            $oname = Option::find($optionss->option_id);
            array_push($name,$oname);
            // array_push($qty,$oname->quantity);
            // $temp['value']=array('key1'=>$oname->id,'key2'=>$oname->name);
        }
        // dd($name);


        $fromadd = 0;
        $tablenoo = 0;
        $date = new DateTime('Asia/Yangon');

        $real_date = $date->format('d-m-Y h:i:s');
        $code_lists = json_decode($request->code_lists);
        $notte = [];
        if($code_lists != null){
            foreach($code_lists as $code){
                $remark_note = DB::table('option_shop_order')
                    ->where('option_id',$code->id)
                    ->update(['note' => $code->remark]);
                $note_remark = DB::table('option_shop_order')
                    ->where('option_id',$code->id)
                    ->first();
                array_push($notte,$note_remark);
            }
        }
        return view('Customer.kitchen_lists',compact('take_away','notte','orders','tableno','option_name','real_date','oname','name','alloption','fromadd','tablenoo'));

    }
    protected function addMoreItemUI($order_id){  //Finished UI
        $table = 1;
        try {

            $order = ShopOrder::findOrFail($order_id);

        } catch (\Exception $e) {

            alert()->error("Shop Order Not Found!")->persistent("Close!");

            return redirect()->back();

        }

        $items = MenuItem::all();

        $meal_types = Meal::all();

        $codes = Code::all();

        $cuisine_types = CuisineType::all();

        DB::table('option_shop_order')
            ->where('shop_order_id', $order_id)
            ->update(['tocook' => 0]);

        $table_number = $order->table->table_number??0;
        // dd($table);
        return view('Customer.order_sale_page', compact('codes','items','meal_types','cuisine_types','table_number','order','table'));
    }
    protected function getCountingUnitsByItemId(Request $request){

        $item_id = $request->item_id;

        $item = MenuItem::where('id', $item_id)->first();

        $units = Option::where('menu_item_id', $item->id)->with('menu_item')->get();

        return response()->json($units);
    }
    protected function getPendingDeliveryOrderList(){

        $pending_lists = Order::where('status', 2)->get();
        // dd('hello');
        return view('Sale.delivery_pending_lists', compact('pending_lists'));
    }
    protected function getPendingShopOrderList(){

        $pending_lists = ShopOrder::where('status', 1)->get();

        $promotion = Promotion::all();

        return view('Customer.pending_lists', compact('pending_lists','promotion'));
    }
}
