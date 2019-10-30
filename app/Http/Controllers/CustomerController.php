<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Exports\ExportCustomers;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;

class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('customers.index');
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

        Customer::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Created'
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
        $customer = Customer::find($id);
        return $customer;
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

        $customer = Customer::findOrFail($id);

        $this->validate($request, [
            'name'      => 'required|string|min:2',
            'address'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255|unique:customers,email'.$customer->id,
            'phone'   => 'required|string|min:2',
        ]);

        $customer->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Updated'
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
        Customer::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Delete'
        ]);
    }

    public function apiCustomers()
    {
        $customer = Customer::all();

        return Datatables::of($customer)
            ->addColumn('action', function($customer){
                return '<a onclick="editForm('. $customer->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $customer->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
                Excel::import(new CustomersImport, $file); //IMPORT FILE
                return redirect()->back()->with(['success' => 'Upload file data customers !']);
            }
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportCustomersAll()
    {
        $customers = Customer::all();
        $pdf = PDF::loadView('customers.CustomersAllPDF',compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCustomers)->download('customers.xlsx');
    }
}
