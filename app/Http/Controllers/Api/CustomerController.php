<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   

        $salesPersonId = $id;
        $customer = Customer::where('sales_person_id',$salesPersonId)
                            ->paginate(10);
        return response()->json([
                    'status' => true,
                    'data' => $customer
                ]);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('salesPerson.customerManagement.customerAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
                    'customer_name'=>'required|max:100',
                    'phone_no'=>'required|unique:customers|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15',
                    'address'=>'required|max:1000'
                ]);

        if(!$validator->fails()){
                $data = new customer;
                $data->sales_person_id = $request->sales_person_id;
                $data->customer_name = $request->customer_name;
                $data->phone_no = $request->phone_no;
                $data->address = $request->address;
                $data->save();
                return response()->json([
                            'status' => true,
                            'status' => 'Customer Added Successfully.'
                        ]);  
        }else{
                    return response()->json([
                            'status' => false,
                            'message' => $validator->messages()->first(),
                        ]);
            }    
    
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
    public function edit($id)
    {   

        $salesPersonId = $id;
        $customer = Customer::find($salesPersonId);
        return response()->json([
                    'status' => true,
                    'data' => $customer
                ]);  
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        if($request->phone_no === $request->old_phone_no){
              $validator = Validator::make($request->all(), [
                    'customer_name'=>'required|max:100',
                    'address'=>'required|max:1000'
                ]);

         }else{
                  $validator = Validator::make($request->all(), [
                        'customer_name'=>'required|max:100',
                        'phone_no'=>'required|unique:customers|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:15',
                        'address'=>'required|max:1000'
                ]);
        }

        if(!$validator->fails()){
            $customerId = $request->customer_id;
            $customer = Customer::find($customerId);
            $customer->customer_name = $request->customer_name;
            $customer->phone_no = $request->phone_no;
            $customer->address = $request->address;
            $customer->update();
            return response()->json([
                        'status' => true,
                        'msg' => 'Customer Updated Successfully.'
                    ]);  
        }else{
                    return response()->json([
                            'status' => false,
                            'message' => $validator->messages()->first(),
                        ]);
            }   


        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $salesPersonId = $id;
        $customer = Customer::find($salesPersonId);
        $customer->delete();
        return response()->json([
                    'status' => true,
                    'msg' => 'Customer Deleted Successfully.'
                ]);  

    }
}
