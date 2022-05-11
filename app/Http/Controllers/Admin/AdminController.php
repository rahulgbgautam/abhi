<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\salesPerson;
use App\Models\Customer;
use App\Models\product;
use Mail;
use Auth;



class AdminController extends Controller 
{

    public function index(Request $request){
        if($request->session()->has('admin')){
            return redirect('/admin/dashboard');
        }else{
            return view('admin.auth.login');
        }
    }

    public function dashboard(Request $request){ 
        $adminId = session('admin')['id'];
        $adminInfo = User::find($adminId);
        $adminName = $adminInfo->name;
 
        $salesPersonCount = salesPerson::count(); 
        $customerCount = Customer::count(); 
        $productCount = product::count(); 

        return view('admin.dashboard',compact('salesPersonCount','customerCount','productCount','adminName'));
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            // 'g-recaptcha'=>'required|recaptcha'
        ]);

        $admin = User::where(['email'=>$request->email])->first();
        if($admin)
        {  
            // return $admin;
            if(!Hash::check($request->password,$admin->password))
            {  
                return back()->with('errorMessage',"Please enter correct email and password.");
            }else{ 
                if($admin->type=="admin"){
                    if(strtolower($admin->status)=="active"){
                        $request->session()->put('admin',$admin);
                        // Auth::login($admin);
                        return redirect('admin/dashboard');
                    }else{
                        return back()->with('errorMessage',"Your account is blocked by admin. Please contact to admin.");
                    }
                }else{
                    return back()->with('errorMessage',"You are not having admin section access. Please contact to admin.");
                }
            }

        }else{      
            return back()->with('errorMessage',"Your account does not exist.");
        }

    }

}
