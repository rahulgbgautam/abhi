<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\salesPerson;
use App\Models\Allotment;
use App\Models\Customer;
use App\User;

class UserController extends Controller
{
    
    public function index(Request $request){
        if($request->session()->has('salesPerson')){
            return redirect('/sales-person/dashboard');
        }else{
            return view('salesPerson.auth.login');
        }
    }

    public function dashboard(Request $request){ 

        $salesPersonId = session('salesPerson')['id'];
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
        return view('salesPerson.dashboard',compact('customerCount','products','salesPersonName'));
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $salesPerson = salesPerson::where(['email'=>$request->email])->first();

        if($salesPerson)
        {  
            if(!Hash::check($request->password,$salesPerson->password))
            {  
                return back()->with('errorMessage',"Please enter correct email and password.");
            }else{ 
                    $request->session()->put('salesPerson',$salesPerson);
                    return redirect('/sales-person/dashboard');
            }

        }else{      
            return back()->with('errorMessage',"Your account does not exist.");
        }

    }


}
