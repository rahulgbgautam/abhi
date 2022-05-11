<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allotment;


class ProductReturn extends Controller
{
    public function index()
    {
        $Allotment = Allotment::leftjoin('sales_person','allotments.sales_person_id','=','sales_person.id')
            ->groupBy('allotments.sales_person_id')->paginate(10);
        return view('admin.returnProduct.returnProductList',compact('Allotment'));
    }
    public function todaysReturn($id)
    {
        $allotedProduct = Allotment::leftJoin('products','allotments.product_id','=','products.id')
                                    ->select('allotments.*','products.product_name')
                                    ->where('allotments.sales_person_id',$id)
        							->where('allotments.created_at', 'like', date("Y-m-d")."%")
        							->paginate(10);
       return view('admin.returnProduct.returnProduct',compact('allotedProduct')); 							

    }
    public function allReturn($id)
    {
        $allotedProduct = Allotment::leftJoin('products','allotments.product_id','=','products.id')
                                    ->select('allotments.*','products.product_name')
                                    ->where('allotments.sales_person_id',$id)
        							->paginate(10);
       return view('admin.returnProduct.returnProductAll',compact('allotedProduct')); 	
    }
}
