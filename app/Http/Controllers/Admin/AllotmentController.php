<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Allotment;
use App\Models\salesPerson;
use App\Models\product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $Allotment = Allotment::leftjoin('sales_person','allotments.sales_person_id','=','sales_person.id')
            ->groupBy('allotments.sales_person_id')->paginate(10);
        // return $Allotment;
        return view('admin.allotment.allotmentList',compact('Allotment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $salesPerson = salesPerson::all();
        $product = product::all();
        return view('admin.allotment.allotmentAdd',compact('salesPerson','product'));
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
            'sales_person'=>'required',
            'product.*'=>'required',
            'quantity.*'=>'required'
        ]);

        $sales_person_id = $request->sales_person;
        $product_id = $request->product;
        $quantity_id = $request->quantity;
        foreach ($product_id as $key => $value) {
            $data = new Allotment;
            $data->sales_person_id = $sales_person_id;
            $data->product_id = $value;
            $data->quantity = $quantity_id[$key];
            $data->save();
        }
        $request->session()->flash('successMsg','Product Allotment Successfully.');
        return redirect()->route('allotment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allotment  $allotment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $todayAllotedProd = Allotment::leftjoin('products','allotments.product_id','=','products.id')
            ->select('allotments.*','products.product_name')
            ->where('allotments.sales_person_id',$id)
            ->where('allotments.created_at', 'like', date("Y-m-d")."%")
            ->paginate(10);
        
            return view('admin.allotment.allotmentShow',compact('todayAllotedProd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allotment  $allotment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $allotmentData = Allotment::where('id',$id)->first();
        $product = product::all();
        return view('admin.allotment.allotmentEdit',compact('product','allotmentData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allotment  $allotment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allotment $allotment)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'product'=>'required',
            'quantity'=>'required'
        ]);

        $allotment->product_id = $request->product;
        $allotment->quantity = $request->quantity;
        $allotment->update();
        $request->session()->flash('successMsg','Product Updated Successfully.');
        return redirect()->route('allotment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allotment  $allotment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allotment $allotment)
    {
        //
    }

    public function previousRecords($id)
    {
        $allotedProd = Allotment::leftjoin('products','allotments.product_id','=','products.id')
            ->select('allotments.*','products.product_name')
            ->where('allotments.sales_person_id',$id)
            ->paginate(10);
        return view('admin.allotment.allotmentShow',compact('allotedProd'));    
    }

}
