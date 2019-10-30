<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Exports\ExportProductOut;
use App\Product;
use App\Product_Out;
use App\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;


class ProductOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $customers = Customer::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $invoice_data = Product_Out::all();
        return view('product_out.index', compact('products','customers', 'invoice_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'product_id'     => 'required',
           'customer_id'    => 'required',
           'qty'            => 'required',
           'date'           => 'required'
        ]);

        Product_Out::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty -= $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products Out Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Product_Out = Product_Out::find($id);
        return $Product_Out;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id'     => 'required',
            'customer_id'    => 'required',
            'qty'            => 'required',
            'date'           => 'required'
        ]);

        $Product_Out = Product_Out::findOrFail($id);
        $Product_Out->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty -= $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product Out Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product_Out::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products Delete Deleted'
        ]);
    }



    public function apiProductsOut(){
        $product = Product_Out::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->name;
            })
            ->addColumn('customer_name', function ($product){
                return $product->customer->name;
            })
            ->addColumn('multiple_export', function ($product){
                return '<input type="checkbox" name="exportpdf[]" class="checkbox" value="'. $product->id .'">';
            })
            ->addColumn('action', function($product){
                return '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['multiple_export','products_name','customer_name','action'])->make(true);

    }

    public function exportProductOutAll()
    {
        $Product_Out = Product_Out::all();
        $pdf = PDF::loadView('product_out.productOutAllPDF',compact('Product_Out'));
        return $pdf->download('product_out.pdf');
    }

    public function exportProductOut(Request $request)
    {
        $idst = explode(",",$request->exportpdf);
        $Product_Out = Product_Out::find($idst);
        $companyInfo = Company::find(1);

        $pdf = PDF::setOptions([
            'images' => true,
            'isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true
        ])->loadView('product_out.productOutPDF', compact('Product_Out', 'companyInfo'))->setPaper('a4', 'portrait')->stream();
        return $pdf->download(date("Y-m-d H:i:s",time()).'_Product_Out.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProductOut)->download('product_out.xlsx');
    }

    public function checkAvailable($id)
    {
        $Product = Product::findOrFail($id);
        return $Product;
    }
}
