<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $salesPersonId = session('salesPerson')['id'];
        $customer = Customer::where('sales_person_id',$salesPersonId)
                            ->paginate(10);
        return view('salesPerson.customerManagement.customerList',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salesPerson.customerManagement.customerAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name'=>'required|max:100',
            'phone_no'=>'required|unique:customers|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15',
            'address'=>'required|max:1000'
        ]);

        // return $request->all();
        $data = new customer;
        $data->sales_person_id = $id = session('salesPerson')['id'];
        $data->customer_name = $request->customer_name;
        $data->phone_no = $request->phone_no;
        $data->address = $request->address;
        $data->save();
        $request->session()->flash('successMsg','Customer Added Successfully.');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('salesPerson.customerManagement.customerEdit',compact('customer'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        
        if($request->phone_no === $request->old_phone_no){
              $validatedData = $request->validate([
                'customer_name'=>'required|max:100',
                'address'=>'required|max:1000'
            ]);
         }else{
            $validatedData = $request->validate([
                'customer_name'=>'required|max:100',
                'phone_no'=>'required|unique:customers|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15',
                'address'=>'required|max:1000'
            ]);         
        }

        $customer->customer_name = $request->customer_name;
        $customer->phone_no = $request->phone_no;
        $customer->address = $request->address;
        $customer->update();
        $request->session()->flash('successMsg','Customer Updated Successfully.');
        return redirect()->route('customer.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('successMsg',"Customer Deleted Successfully.");
    }
}
