<?php

namespace App\Http\Controllers\Web;

use App\Ingredient;
use App\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    protected function getPurchaseHistory(Request $request){

        $purchase_lists = Purchase::all();

        return view('Purchase.purchase_lists', compact('purchase_lists'));
    }

    protected function createPurchaseHistory(){

        $ingredients = Ingredient::all();

        return view('Purchase.create_purchase', compact('ingredients'));
    }

    protected function getPurchaseHistoryDetails($id){

        try {  

            $purchase = Purchase::findOrFail($id);

        } catch (\Exception $e) {
            
            alert()->error('Something Wrong! Purchase Cannot be Found.');

            return redirect()->back();
        }

        return view('Purchase.purchase_details', compact('purchase'));
    }

    protected function storePurchaseHistory(Request $request){

        $validator = Validator::make($request->all(), [
            'purchase_date' => 'required',
            'supp_name' => 'required',
            'ingredient' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);

        if ($validator->fails()) {

            alert()->error("Something Wrong! Validation Error");

            return redirect()->back();
        }

        $user_code = $request->session()->get('user')->id;

        $ingredient = $request->ingredient;

        $price = $request->price;

        $qty = $request->qty;

        $total_qty = 0;

        $total_price = 0;

        foreach ($price as $p) {
            
            $total_price += $p;
        }

        foreach ($qty as $q) {
            
            $total_qty += $q;
        }

        try {

            $purchase = Purchase::create([
                'supplier_name' => $request->supp_name,
                'total_quantity' => $total_qty,
                'total_price' => $total_price,
                'purchase_date' => $request->purchase_date,
                'purchase_by' => $user_code,
            ]);


            for($count = 0; $count < count($ingredient); $count++){

                $purchase->ingredient()->attach($ingredient[$count], ['quantity' => $qty[$count], 'price' => $price[$count]]);

                $ingredient_update = Ingredient::find($ingredient[$count]);

                $balance_qty = ($ingredient_update->instock_quantity + $qty[$count]);

                $ingredient_update->instock_quantity = $balance_qty;

                $ingredient_update->purchase_price = $price[$count];

                $ingredient_update->save();
                
            }

        } catch (\Exception $e) {
            
            alert()->error('Something Wrong! When Purchase Store.');

            return redirect()->back();
        }

        alert()->success("Success");
            
        return redirect()->route('purchase_list');
    }
}
