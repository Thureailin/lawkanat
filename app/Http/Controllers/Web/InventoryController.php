<?php

namespace App\Http\Controllers\Web;

use App\Code;
use App\Meal;
use App\Option;
use App\MenuItem;
use App\Ingredient;
use App\CuisineType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    protected function getInventoryDashboard()
	{
		return view('Inventory.inv_dashboard');
	}

	//Start Meal
	protected function getMealList()
	{
		$meal_lists =  Meal::all();

		return view('Inventory.meal_list', compact('meal_lists'));
	}

	protected function storeMeal(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user_code = $request->session()->get('user')->id;

        try {

            $meal = Meal::create([
                'name' => $request->name,
                'created_by' => $user_code,
            ]);

        } catch (\Exception $e) {

            alert()->error('Something Wrong! When Creating Meal.');

            return redirect()->back();
        }


    	alert()->success('Successfully Added');

        return redirect()->route('meal_list');
	}

	protected function updateMeal($id, Request $request)
	{
		try {

        	$meal = Meal::findOrFail($id);

   		} catch (\Exception $e) {

        	alert()->error("Meal Not Found!")->persistent("Close!");

            return redirect()->back();

    	}

        $meal->name = $request->name;

        $meal->save();

        alert()->success('Successfully Updated!');

        return redirect()->route('meal_list');
	}
	//End Meal

	//Start Cuisine Type
	protected function getCuisineTypeList()
	{
		$cuisine_type_lists =  CuisineType::all();

		$meal_lists =  Meal::all();

		return view('Inventory.cuisine_type_list', compact('cuisine_type_lists','meal_lists'));
	}

	protected function storeCuisineType(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'meal_id' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_code = $request->session()->get('user')->id;

        try {

            $category = CuisineType::create([
                'name' => $request->name,
                'meal_id' => $request->meal_id,
                'created_by' => $user_code,
            ]);

        } catch (\Exception $e) {

            alert()->error('Something Wrong! When Creating Cuisine Type.');

            return redirect()->back();
        }


    	alert()->success('Successfully Added');

        return redirect()->route('cuisine_type_list');
	}

	protected function updateCuisineType($id, Request $request)
	{
		try {

        	$cuisine = CuisineType::findOrFail($id);

   		} catch (\Exception $e) {

        	alert()->error("Cuisine Type Not Found!")->persistent("Close!");

            return redirect()->back();

    	}

        $cuisine->name = $request->name;

        $cuisine->meal_id = $request->meal_id;

        $cuisine->save();

        alert()->success('Successfully Updated!');

        return redirect()->route('cuisine_type_list');
	}
	//End Cuisine Type

	//Start Menu Item
	protected function getMenuItemList()
	{
		$menu_item_lists =  MenuItem::whereNull("deleted_at")->orderBy('cuisine_type_id', 'ASC')->get();

		$cuisine_type_lists =  CuisineType::all();

		return view('Inventory.item_list', compact('menu_item_lists','cuisine_type_lists'));
	}

    protected function getCustomerComplainList()
	{
        $codes = Code::all();

		return view('Inventory.code_list',compact('codes'));
	}

    protected function storeCode(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $code = Code::create([
                'code' => $request->code,
                'name' => $request->name,
            ]);

        } catch (\Exception $e) {

            alert()->error('Something Wrong! When Creating Meal.');

            return redirect()->back();
        }


    	alert()->success('Successfully Added');

        return redirect()->route('customer_complain_list');
	}

    protected function updateCode($id, Request $request)
	{
		try {

        	$code = Code::findOrFail($id);

   		} catch (\Exception $e) {

        	alert()->error("Code Not Found!")->persistent("Close!");

            return redirect()->back();

    	}

        $code->code = $request->code;
        $code->name = $request->name;

        $code->save();

        alert()->success('Successfully Updated!');

        return redirect()->route('customer_complain_list');
	}

	protected function storeMenuItem(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'cuisine_type_id' => 'required',
        ]);

        if ($validator->fails()) {

        	alert()->error('Validation Error!');

            return redirect()->back();
        }

        $user_code = $request->session()->get('user')->id;

        if (isset($request->customer_console)) {

        	$customer_console = 0;   //Customer ko pya mar

        }else{

        	$customer_console = 1;	//Customer ko ma pya
        }

        if ($request->hasfile('photo_path')) {

			$image = $request->file('photo_path');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() . '/photo/', $photo_path);
		}
		else{

			$photo_path = "default.jpg";

		}

        try {

            $item = MenuItem::create([
                'item_code' => $request->code,
                'item_name' => $request->name,
                'created_by' => $user_code,
                'photo_path' => $photo_path,
                'customer_console' => $customer_console,
                'cuisine_type_id' => $request->cuisine_type_id,
            ]);

        } catch (\Exception $e) {

            alert()->error('Something Wrong! When Creating Menu Item.');

            return redirect()->back();
        }

        alert()->success('Successfully Added');

        return redirect()->route('menu_item_list');
	}

    protected function updateMenuItem($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {

            alert()->error('Something Wrong!');

            return redirect()->back();
        }

        try {

            $item = MenuItem::findOrFail($id);

        } catch (\Exception $e) {

            alert()->error("Menu Item Not Found!")->persistent("Close!");

            return redirect()->back();

        }

        if (isset($request->customer_console)) {

        	$customer_console = 0;   //Customer ko pya mar

        }else{

        	$customer_console = 1;	//Customer ko ma pya
        }

        if ($request->hasfile('photo_path')) {

			$image = $request->file('photo_path');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() . '/photo/', $photo_path);
		}
		else{

			$photo_path = "default.jpg";

		}

        $item->item_code = $request->code;

        $item->item_name = $request->name;

        $item->customer_console = $customer_console;

        $item->photo_path = $photo_path;

        $item->cuisine_type_id = $request->cuisine_type_id;

        $item->save();

        alert()->success('Successfully Updated!');

        return redirect()->back();
    }

    protected function deleteMenuItem(Request $request) //Not Finish
    {
        $id = $request->item_id;

        $item = MenuItem::find($id);

        $counting_units = Option::where('menu_item_id', $item->id)->get();

        foreach ($counting_units as $unit) {

            $unit->delete();
        }

        $item->delete();
        alert()->success('Successfully Deleted!');
        return back();
    }



    protected function getOptionList($item_id)
    {

        $units = Option::where('menu_item_id', $item_id)->whereNull("deleted_at")->get();

        $ingredient_lists = Ingredient::all();

        try {

            $item = MenuItem::findOrFail($item_id);

        } catch (\Exception $e) {

            alert()->error("Menu Item Not Found!")->persistent("Close!");

            return redirect()->back();
        }

        return view('Inventory.unit_list', compact('units','item','ingredient_lists'));
    }

    protected function changeBrake($id){
            $change = Option::find($id);
            // dd($change);
            $change->brake_flag = 2;
            $change->save();
            return back();
    }
    protected function changeUnbrake($id){
        $change = Option::find($id);
        // dd($change);
        $change->brake_flag = 1;
        $change->save();
        return back();
}

    protected function storeOption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sale_price' => 'required',
            'est_cost_price' => 'required',
            'size' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_code = $request->session()->get('user')->id;

        // $amount = $request->amount;

        // $ingredient = $request->ingredient;

        try {

            $option = Option::create([
                'name' => $request->name,
                'sale_price' => $request->sale_price,
                'est_cost_price' => $request->est_cost_price,
                'size' => $request->size,
                'created_by' => $user_code,
                'menu_item_id' => $request->item_id,
            ]);


            // for($count = 0; $count < count($amount); $count++){

            //     $option->ingredient()->attach($ingredient[$count], ['amount' => $amount[$count]]);

            // }

        } catch (\Exception $e) {

            // alert()->error('Something Wrong! When Creating Option.');

            return redirect()->back();
        }

        alert()->success('Successfully Stored!');

        return redirect()->back();
    }

    protected function updateOption($id,Request $request)
    {
        try {

            $unit = Option::findOrFail($id);

        } catch (\Exception $e) {

            alert()->error("Option Not Found!")->persistent("Close!");

            return redirect()->back();

        }

        $unit->name = $request->name;

        $unit->sale_price = $request->sale_price;

        $unit->est_cost_price = $request->est_cost_price;

        $unit->size = $request->size;

        $unit->save();

        alert()->success('Successfully Stored!');

        return redirect()->back();
    }

    protected function deleteOption(Request $request) //Not Finish
    {
        $id = $request->unit_id;

        $unit = Option::findOrFail($id);

        $unit->delete();

        return response()->json($unit);
    }

    protected function getIngredientList()
    {
        $ingredient_lists = Ingredient::all();

        return view('Inventory.raw_material_list', compact('ingredient_lists'));
    }

    protected function storeIngredient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'purchase_price' => 'required',
            'unit' => 'required',
            'reorder_qty' => 'required',
            'instock_qty' => 'required',
            'brand_name' => 'required',
            'supplier_name' => 'required',
        ]);

        if ($validator->fails()) {

            alert()->error('Validation Error!');

            return redirect()->back()->withErrors($validator);
        }

        try {

            $ingredient = Ingredient::create([
                'name' => $request->name,
                'purchase_price' => $request->purchase_price,
                'unit' => $request->unit,
                'reorder_quantity' => $request->reorder_qty,
                'instock_quantity' =>  $request->instock_qty,
                'brand_name' => $request->brand_name,
                'supplier_name' => $request->supplier_name,
            ]);

        } catch (\Exception $e) {

            alert()->error('Something Wrong! When Creating Ingredients.');

            return redirect()->back();
        }

        alert()->success('Successfully Added');

        return redirect()->route('ingredient_list');
    }

    // protected function updateIngredient($id, Request $request) // Ma pee tay
    // {

    // }

    protected function editUnitIngredient($id){

        // dd($id);
        try {

            $option = Option::findOrFail($id);

        } catch (\Exception $e) {

            alert()->error("Option Type Not Found!")->persistent("Close!");

            return redirect()->back();

        }

        $ingredients = $option->ingredient;

        // foreach($ingredients as $ingred)
        //   $amount = $ingred->pivot->amount;

        $ingredient_lists = Ingredient::all();

        // dd("he");
        // $ingredient_lists->option()->attach($option->id, ['amount' => $amount]);
        // dd(ingredient_lists);
        // dd($ingredients);
        return view ('Inventory.edit_unit_ingredient', compact('ingredients','ingredient_lists','id'));

    }

    protected function updateUnitIngredient($id, Request $request){

        try {

            $option = Option::findOrFail($id);

        } catch (\Exception $e) {

            alert()->error("Option Type Not Found!")->persistent("Close!");

            return redirect()->back();

        }

        $amount = $request->amount;

        $ingredient = $request->ingredient;

        $option->ingredient()->detach();

        for($count = 0; $count < count($amount); $count++){

            $option->ingredient()->attach($ingredient[$count], ['amount' => $amount[$count]]);

        }

        alert()->success('Successfully Updated');

        return redirect()->back();

    }

    protected function getReorderList(Request $Request){

        $reorder = Ingredient::all();
        // foreach($reorder as $reorders)
        // if()
        return view('Inventory.reorder_list',compact('reorder'));
    }

    protected function stockCountUpdate(Request $Request){
        $all_ingre = Ingredient::all();
        return view('Inventory.stock_update',compact('all_ingre'));
    }

    protected function editIngredient(Request $request)
    {
        // dd($request->ingredient_id);
        $edit_ingre = Ingredient::find($request->ingredient_id);
       return response()->json($edit_ingre);
    }
    protected function store_updateIngredient(Request $request)
    {
        // dd($request->all());
        $Ingre = Ingredient::find($request->ingreID);
        $Ingre->name = $request->ingre_name;
        $Ingre->purchase_price = $request->purchase;
        $Ingre->unit = $request->unit;
        $Ingre->reorder_quantity = $request->reorder;
        $Ingre->instock_quantity = $request->instock;
        $Ingre->brand_name = $request->brand;
        $Ingre->supplier_name = $request->supplier;
        $Ingre->save();
        return back();
    }
    protected function upadate_stock(Request $request)
    {
        $ingre = Ingredient::find($request->ingre_ID);
        return response()->json($ingre);
    }
    protected function upadate_onlyStock(Request $request)
    {
        $stock = Ingredient::find($request->ingid);
        // dd($stock);
        $stock->instock_quantity = $request->stock;
        $stock->save();
        return back();
    }
}
