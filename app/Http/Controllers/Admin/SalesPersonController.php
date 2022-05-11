<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\salesPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesPerson = salesPerson::latest('id')->paginate(10);
        return view('admin.salesPerson.salesPersonList',compact('salesPerson'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.salesPerson.salesPersonAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd("vnfkj");
        $validatedData = $request->validate([
            'name'=>'required|max:100',
            'phone_no'=>'required|unique:sales_person|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15',
            'email'=>'required|email|unique:sales_person',
            'password'=>'required|max:200'
            
        ]);

        // return $request->all();
        $data = new salesPerson;
        $data->name = $request->name;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        $request->session()->flash('successMsg','Sales Person Added Successfully.');
        return redirect()->route('sales-person.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\salesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function show(salesPerson $salesPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(salesPerson $salesPerson)
    {
        // $salesPerson = salesPerson::find($id);
        // return $salesPerson;
        return view('admin.salesPerson.salesPersonEdit',compact('salesPerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salesPerson $salesPerson)
    {
         
         if($request->phone_no === $request->old_phone_no){
                $validatedData = $request->validate([
                'name'=>'required|max:100',
                'phone_no'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15'
            ]);
         }else{
            $validatedData = $request->validate([
                'name'=>'required|max:100',
                'phone_no'=>'required|unique:sales_person|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15'
            ]);
         }
        $salesPerson->name = $request->name;
        $salesPerson->phone_no = $request->phone_no;
        $salesPerson->update();
        $request->session()->flash('successMsg','Sales Person Updated Successfully.');
        return redirect()->route('sales-person.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salesPerson  $salesPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(salesPerson $salesPerson)
    {
       
        $salesPerson->delete();
        return redirect()->route('sales-person.index')->with('successMsg',"Sales Person Deleted Successfully.");
    }
}
