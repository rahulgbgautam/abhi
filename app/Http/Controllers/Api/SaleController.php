<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Allotment;
use App\Models\Customer;
use App\Models\SellCustomer;
use App\Models\product;
use App\Models\Amount;
use PDF;


class SaleController extends Controller
{
    public function index($uid)
    {	
        
        $id = $uid;
        $allotedProduct = Allotment::leftJoin('products','allotments.product_id','=','products.id')
                                    ->select('allotments.*','products.product_name')
                                    ->where('allotments.sales_person_id',$id)
        							->where('allotments.created_at', 'like', date("Y-m-d")."%")
        							->paginate(10);                          
        return response()->json([
                    'status' => true,
                    'data' => $allotedProduct
                ]);  
    }

    public function sell($id)
    {	
    	$sales_person_id = $id;
    	$customer = Customer::where('sales_person_id',$sales_person_id)->get();
        $allotedProduct = Allotment::leftJoin('products','allotments.product_id','=','products.id')
                                    ->select('allotments.*','products.product_name','products.cost_price','products.selling_price')
                                    ->where('allotments.sales_person_id',$sales_person_id)
                                    ->where('allotments.created_at', 'like', date("Y-m-d")."%")
                                    ->paginate(10);
                           
    	 
        $data = array();
        $data['allotedProduct'] = $allotedProduct;                                
        $data['customer'] = $customer;                                
        return response()->json([
                    'status' => true,
                    'data' => $data
                ]);   
        
    }

    public function sellCustomer(Request $request)
    {   
        
         $sales_person_id = $request->sales_person_id;
         $customer_id = $request->customer_id;
         $products = $request->product;
         $sell_quantity = $request->sell_quantity;
         $paying_amount = $request->paying_amount;
         $discount = $request->discount;
        
         foreach ($products as $key => $product){          
                $AllotedProd = Allotment::where('sales_person_id',$sales_person_id)
                                    ->where('product_id',$product)
                                    ->where('created_at', 'like', date("Y-m-d")."%")
                                    ->first();
                $alloted_quantity = $AllotedProd->quantity;
                $quantity = $sell_quantity[$key];
                $available_quantity = $AllotedProd->quantity - $AllotedProd->sell_quantity;

                if ($quantity<=$available_quantity) {
        
                }else{
                
                    return response()->json([
                        'status' => false,
                        'msg' => "Quantity should not greater from avalable quantity",
                        'data' => $available_quantity
                    ]);   
            }                    
         }

         $customerInfo = Customer::find($customer_id);
         $product_name = array();
         $product_price = array();
         $grand_total=0;
         foreach ($products as $key => $product){    
            $productInfo = product::where('id',$product)->first();
            array_push($product_name,$productInfo->product_name);
            array_push($product_price,$productInfo->selling_price);
            $grand_total = $grand_total+$productInfo->selling_price*$sell_quantity[$key];
        }
        $amount_after_discount = $grand_total - $discount;
        $udhar_amount = $amount_after_discount - $paying_amount;

        if ($request->check_invoice){
            
                $allData1 = array();
                $allData1['product_name'] = $product_name;
                $allData1['product_price'] = $product_price;
                $allData1['customerInfo'] = $customerInfo;
                $allData1['sell_quantity'] = $sell_quantity;
                $allData1['grand_total'] = $grand_total;
                $allData1['paying_amount'] = $paying_amount;
                $allData1['udhar_amount'] = $udhar_amount;
                $allData1['discount'] = $discount;
                $allData1['amount_after_discount'] = $amount_after_discount;

                return response()->json([
                            'status' => false,
                            'data' => $allData1
                        ]); 
        }else{

                foreach ($products as $key => $product) {   
                    $AllotedProd = Allotment::where('sales_person_id',$sales_person_id)
                                        ->where('product_id',$product)
                                        ->where('created_at', 'like', date("Y-m-d")."%")
                                        ->first();

                    $alloted_quantity = $AllotedProd->quantity;
                    $quantity = $sell_quantity[$key];
                    $available_quantity = $AllotedProd->quantity - $AllotedProd->sell_quantity;
                        $AllotedProd->sell_quantity = $AllotedProd->sell_quantity+$quantity;  
                        $AllotedProd->update();
                        $data = new SellCustomer;
                        $data->sales_person_id = $sales_person_id;
                        $data->customer_id = $customer_id;
                        $data->product_id = $product;
                        $data->sell_quantity = $quantity;
                        $data->alloted_quantity = $alloted_quantity;
                        $data->save();   
                          
                }

                        $data = new Amount;
                        $data->sales_person_id = $sales_person_id;
                        $data->customer_id = $customer_id;
                        $data->total_amount = $grand_total;
                        $data->paid_amount = $paying_amount;
                        $data->udhar_amount = $udhar_amount;
                        $data->discount = $discount;
                        $data->amount_after_discount = $amount_after_discount;
                        $data->save();
                        $invoice_num = $data->id;         


            $pdf = PDF::loadView('salesPerson.invoice.invoiceTemp',compact('product_name','product_price','customerInfo','sell_quantity','grand_total','paying_amount','udhar_amount','invoice_num','discount','amount_after_discount'))->setOptions(['defaultFont' => 'sans-serif']);
            
            $pdf_name = $customer_id.'_'.date("Y-m-d");
            $path = public_path('pdf/');
            $pdf->save($path . '/' . $pdf_name.'.pdf');
            // $url = asset('/PDF/invoice.pdf');
            $url = url('public/PDF/'.$pdf_name.'.pdf');
                        // $allData2 = array();
                        // $allData2['product_name'] = $product_name;
                        // $allData2['product_price'] = $product_price;
                        // $allData2['customerInfo'] = $customerInfo;
                        // $allData2['sell_quantity'] = $sell_quantity;
                        // $allData2['grand_total'] = $grand_total;
                        // $allData2['paying_amount'] = $paying_amount;
                        // $allData2['udhar_amount'] = $udhar_amount;
                        // $allData2['invoice_num'] = $invoice_num;
                return response()->json([
                                'status' => false,
                                'msg' => 'Product Sell To Customer Successfully.',
                                'pdf_url' => $url,              
                            ]);    
        }
        
         
    }

}
