<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::find(1);
        return view('company.index', compact('company'));
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
            'name'   => 'required|string|min:2',
            'address' => 'required',
            'key_api' => 'required',
            'email' => 'required',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Companys Update'
        ]);
    }
}
