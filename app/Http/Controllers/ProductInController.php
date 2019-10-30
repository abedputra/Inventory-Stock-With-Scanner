<?php

namespace App\Http\Controllers;


use App\Exports\ExportProductIn;
use App\Product;
use App\Product_In;
use App\Supplier;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ProductInController extends Controller
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

        $suppliers = Supplier::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $invoice_data = Product_In::all();
        return view('product_in.index', compact('products','suppliers','invoice_data'));
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
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'date'        => 'required'
        ]);

        Product_In::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Created'
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
        $Product_In = Product_In::find($id);
        return $Product_In;
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
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'date'        => 'required'
        ]);

        $Product_In = Product_In::findOrFail($id);
        $Product_In->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product In Updated'
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
        Product_In::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Deleted'
        ]);
    }



    public function apiProductsIn(){
        $product = Product_In::all();

        return Datatables::of($product)
            ->addColumn('products_name', function ($product){
                return $product->product->name;
            })
            ->addColumn('supplier_name', function ($product){
                return $product->supplier->name;
            })
            ->addColumn('multiple_export', function ($product){
                return '<input type="checkbox" name="exportpdf[]" class="checkbox" value="'. $product->id .'">';
            })
            ->addColumn('action', function($product){
                return '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['multiple_export','products_name','supplier_name','action'])->make(true);

    }

    public function exportProductInAll()
    {
        $Product_In = Product_In::all();
        $pdf = PDF::loadView('product_in.productInAllPDF',compact('Product_In'));
        return $pdf->download('product_in.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProductIn)->download('product_in.xlsx');
    }
}
