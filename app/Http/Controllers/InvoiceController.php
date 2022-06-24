<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

use Illuminate\Support\Facades\Storage;
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
        $invoice=Invoice::where('username','like','dinooo')->get();
        // $quantity=array();
        // foreach($invoice as $inv){
        //     $invdetail=InvoiceDetail::where('id_invoice','=',$inv->id);
        //     $quantity[$inv->id]=0;
        //     foreach($invdetail as $dt){
        //         $quantity[$inv->id]+=$dt->quantity;
        //     }
        // }
        foreach($invoice as $inv){
            if($inv->status==0){
                $inv->status='Waiting for confirmation';
            }else if($inv->status==1){
                $inv->status='Being shipped';
            }else{
                $inv->status='Delivered';
            }
        }
        return view('invoice',['invoice'=>$invoice]);
        
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
        $invoice=Invoice::find($id);
        if($invoice->status==0){
            $invoice->status='Waiting for confirmation';
        }else if($invoice->status==1){
            $invoice->status='Being shipped';
        }else{
            $invoice->status='Delivered';
        }
        $invoicedetail=InvoiceDetail::select('product_details.id','image','name','invoice_details.price','invoice_details.quantity','capacity')
        ->join('product_details','product_details.id','=','invoice_details.id_product')
        ->join('products','products.id','=','product_details.product_id')
        ->where('id_invoice','=',$id)->get();
        $total=0;
        foreach($invoicedetail as $inv){
            $total+=$inv->price*$inv->quantity;
            $inv->image=Storage::url($inv->image);
        }
        return view('invoicedetail',['invoicedetail'=>$invoicedetail,'total'=>$total,'invoice'=>$invoice]);
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
