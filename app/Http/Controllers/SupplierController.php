<?php

namespace App\Http\Controllers;


use App\Exports\ExportSuppliers;
use App\Imports\SuppliersImport;
use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;


class SupplierController extends Controller
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
        $suppliers = Supplier::all();
        return view('suppliers.index');
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
            'email'     => 'required|unique:suppliers',
            'phone'   => 'required',
        ]);

        Supplier::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Suppliers Created'
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
        $supplier = Supplier::find($id);
        return $supplier;
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
        $supplier = Supplier::findOrFail($id);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'address'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255|unique:suppliers,email,'.$supplier->id,
            'phone'   => 'required|string|min:2',
        ]);

        $supplier->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Supplier Updated'
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
        Supplier::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Supplier Delete'
        ]);
    }

    public function apiSuppliers()
    {
        $suppliers = Supplier::all();

        return Datatables::of($suppliers)
            ->addColumn('action', function($suppliers){
                return '<a onclick="editForm('. $suppliers->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $suppliers->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                Excel::import(new SuppliersImport, $file); //IMPORT FILE
                return redirect()->back()->with(['success' => 'Upload file data suppliers !']);
            }
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }

    public function exportSuppliersAll()
    {
        $suppliers = Supplier::all();
        $pdf = PDF::loadView('suppliers.SuppliersAllPDF',compact('suppliers'));
        return $pdf->download('suppliers.pdf');
    }

    public function exportExcel()
    {
        return (new ExportSuppliers)->download('suppliers.xlsx');
    }
}
