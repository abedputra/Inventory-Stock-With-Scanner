<?php

namespace App\Http\Controllers\Api;

use App\Supplier;
use App\Barcode;
use App\Customer;
use App\Product;
use App\Category;
use App\Product_In;
use App\Product_Out;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiDataAndroidController extends Controller
{
	// All suppliers
	public function apiGetAllSuppliers()
    {
        $suppliers = Supplier::all();

        return response()->json([
            'success' => 1,
            'name' => $suppliers
        ]);
    }

    // All customer
    public function apiGetAllCustomer()
    {
        $customer = Customer::all();

        return response()->json([
            'success' => 1,
            'name' => $customer
        ]);
    }

    // All customer
    public function apiGetAllCategories()
    {
        $categories = Category::all();

        return response()->json([
            'success' => 1,
            'name' => $categories
        ]);
    }

    // Save product-in
    public function apiStoreProductIn(Request $request)
    {
    	$detailsCompany = Company::findOrFail(1);
    	// Check the key first
    	if($request['key_api'] == $detailsCompany->key_api){

    		$getBarcode = $request->barcode;
    		$barcodeData = Barcode::where('name', $getBarcode)->first();

    		if(count($barcodeData) == 0){
				return "Barcode is Wrong.";
			}
			
    		$product = Product::where('barcode_id', $barcodeData->id)->first();

    		if(count($product) == 0){
				return "There is no product in common with Barcode.";
			}

    		// Create the product-in
    		$saveIt = new Product_In;
    		$saveIt->product_id = $product->id;
    		$saveIt->supplier_id = $request->supplier_id;
    		$saveIt->qty = $request->qty;
    		$saveIt->date = $request->date;
    		$saveIt->save();

    		// Save product qty
	        $product = Product::findOrFail($product->id);
	        $product->qty += $request->qty;
	        $product->save();

	        return "Success!";
    	}else{
    		return 'Wrong Key.';
    	}
    }

    // Save product-out
    public function apiStoreProductOut(Request $request)
    {
    	$detailsCompany = Company::findOrFail(1);
    	// Check the key first
    	if($request['key_api'] == $detailsCompany->key_api){

    		$getBarcode = $request->barcode;
    		$barcodeData = Barcode::where('name', $getBarcode)->first();

    		if(count($barcodeData) == 0){
				return "Barcode is Wrong.";
			}
			
    		$product = Product::where('barcode_id', $barcodeData->id)->first();

    		if(count($product) == 0){
				return "There is no product in common with Barcode.";
			}

    		// Create the product-in
    		$saveIt = new Product_Out;
    		$saveIt->product_id = $product->id;
    		$saveIt->customer_id = $request->customer_id;
    		$saveIt->qty = $request->qty;
    		$saveIt->date = $request->date;
    		$saveIt->save();

    		// Save product qty
	        $product = Product::findOrFail($product->id);
	        $product->qty -= $request->qty;
	        $product->update();

	        return "Success!";
    	}else{
    		return 'Wrong Key.';
    	}
    }

    // Save product
    public function apiStoreProduct(Request $request)
    {
    	$detailsCompany = Company::findOrFail(1);
    	// Check the key first
    	if($request['key_api'] == $detailsCompany->key_api){
			
    		$input = $request->all();

	        $barcode = new Barcode;
	        $barcode->name = $input['barcode'];
	        $barcode->save();
	        
	        $input['image'] = null;

	        if ($request->hasFile('image')){
	            $input['image'] = '/upload/products/'.str_slug($input['name'], '-').'.'.$request->image->getClientOriginalExtension();
	            $request->image->move(public_path('/upload/products/'), $input['image']);
	        }

	        $input['barcode_id'] = $barcode->id;
	        Product::create($input);

	        return "Success!";
    	}else{
    		return 'Wrong Key.';
    	}
    }
}