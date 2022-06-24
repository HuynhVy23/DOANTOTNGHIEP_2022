<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone'=>'bail|required|numeric|digits:10'
        ]);
        $year =  Carbon::now('Asia/Ho_Chi_Minh')->year;
        $month = (int)Carbon::now('Asia/Ho_Chi_Minh')->month;
        
        if( $month < 10) 
        {
            $month = '0'.$month;
        }
        $day = (int)Carbon::now('Asia/Ho_Chi_Minh')->day;
        
        if($day < 10)
        {
            $day = '0'.$day;
        }
        $hour = Carbon::now('Asia/Ho_Chi_Minh')->hour;
        
        if( $hour < 10) 
        {
            $hour = '0'.$hour;
        }
        $minute = Carbon::now('Asia/Ho_Chi_Minh')->minute;
        
        if( $minute < 10) 
        {
            $minute = '0'.$minute;
        }
        $second = Carbon::now('Asia/Ho_Chi_Minh')->second;
        
        if( $second < 10) 
        {
            $second = '0'.$second;
        }
        $id = $year.$month.$day.$hour.$minute.$second;
        $invoice=new Invoice();
        $invoice->fill([
            'id'=>$id,
            'username'=>'dinooo',
            'shipping_address'=>$request->address,
            'shipping_phone'=>$request->phone,
            'status'=>0,
        ]);
        $invoice->save();
        $product=Cart::select('product_details.id','price','quantity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->where('username','like','dinooo')->get();
        foreach ($product as $pd) {
            $invdetail=new InvoiceDetail();
            $invdetail->fill([
                'id_invoice'=>$id,
                'id_product'=>$pd->id,
                'quantity'=>$request->input('quantity'.$pd->id),
                'price'=>$pd->price
            ]);
            $invdetail->save();
            $productstock=ProductDetail::find($pd->id);
            $productstock->stock=$productstock->stock-$request->input('quantity'.$pd->id);
            $productstock->save();
            $cart=Cart::find($pd->cart);
            $cart->delete();
        }
        return Redirect::back()->withErrors(['success' => 'Final']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
