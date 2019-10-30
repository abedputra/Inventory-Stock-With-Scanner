<?php

namespace App\Http\Controllers;


use App\Exports\ExportSales;
use App\Imports\SalesImport;
use App\Sale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;


class SaleController extends Controller
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
        $sales = Sale::all();
        return view('sales.index');
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
            'name'      => 'required',
            'address'    => 'required',
            'email'     => 'required|unique:customers',
            'phone'   => 'required',
        ]);

        Sale::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Sales Created'
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
        $sale = Sale::find($id);
        return $sale;
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
        $sale = Sale::findOrFail($id);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'address'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255|unique:sales,email,'.$sale->id,
            'phone'   => 'required|string|min:2',
        ]);

        $sale->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Sale Updated'
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
        Sale::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Sales Delete'
        ]);
    }

    public function apiSales()
    {
        $sales = Sale::all();

        return Datatables::of($sales)
            ->addColumn('action', function($sales){
                return '<a onclick="editForm('. $sales->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $sales->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        if ($request->hasFile('file')) {
            //Validasi
            $this->validate($request, [
                'file' => 'required',
                'extension' => 'mimes:xls,xlsx|max:10240',
            ]);
            if ($request->file('file')->isValid()) {
                //UPLOAD FILE
                $file = $request->file('file'); //GET FILE
                Excel::import(new SalesImport, $file); //IMPORT FILE
                return redirect()->back()->with(['success' => 'Upload file data sales !']);
            }
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportSalesAll()
    {
        $sales = Sale::all();
        $pdf = PDF::loadView('sales.SalesAllPDF',compact('sales'));
        return $pdf->download('sales.pdf');
    }

    public function exportExcel()
    {
        return (new ExportSales())->download('sales.xlsx');
    }
}
