<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\salesPerson;
use App\Models\Allotment;
use App\Models\Customer;
use App\User;
use Validator;



class UserController extends Controller
{
    
    // public function index(Request $request){
    //     if($request->session()->has('salesPerson')){
    //         return redirect('/sales-person/dashboard');
    //     }else{
    //         return view('salesPerson.auth.login');
    //     }
    // }

    public function dashboard(Request $request,$id){ 

        $salesPersonId = $id;
        $salesPersonInfo = salesPerson::find($salesPersonId);
        $salesPersonName = $salesPersonInfo->name; 
        $customerCount = Customer::where('sales_person_id',$salesPersonId)
                                    ->count(); 
        
        $allotedProduct = Allotment::leftJoin('products','allotments.product_id','=','products.id')
                                    ->select('allotments.*','products.product_name')
                                    ->where('allotments.sales_person_id',$salesPersonId)
                                    ->where('allotments.created_at', 'like', date("Y-m-d")."%")
                                    ->paginate(10);

        $products = count($allotedProduct);
        $data = array();
        $data['customerCount'] = $customerCount;
        $data['products'] = $products;                                
        $data['salesPersonName'] = $salesPersonName;                                
        return response()->json([
                    'status' => true,
                    'data' => $data
                ]);     

    }

    public function login(Request $request){
     
	    		$validator = Validator::make($request->all(), [
			        'email'=>'required|email',
            		'password'=>'required'
				]);

			if(!$validator->fails()){
		        
		        $salesPerson = salesPerson::where(['email'=>$request->email])->first();	
				
	        	if($salesPerson)
	        	{  

		            if(!Hash::check($request->password,$salesPerson->password))
		            {  
		                return response()->json([
							'status' => false,
							'message' => "Please enter correct email and password.",
						]);
		            }else{ 
		            	
		                        return response()->json([
									'status' => true,
									'message' => "Login successfully",
									'data' =>$salesPerson
								]);
		                    
		                }
		        }else{
		        		return response()->json([
							'status' => false,
							'message' => "Your account does not exist.",
						]);
	    		}
	    	}else{
		        		return response()->json([
							'status' => false,
							'message' => $validator->messages()->first(),
						]);
	    		} 	 

    }
}
