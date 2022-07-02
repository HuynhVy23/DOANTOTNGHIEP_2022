<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
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
        $date = $year.$month.$day.$hour.$minute.$second;
        $invoicedetail=InvoiceDetail::where('invoice_id','=',$request->id)->get();
        
        
       foreach ($invoicedetail as $inv) {
        $product=ProductDetail::where('id','=',$inv->product_id)->first();
        $review=new Review();
           $review->fill([
            'username'=>Auth::user()->username,
            'product_id'=>$product->product_id,
            'content'=>$request->input('review'.$inv->product_id),
            'date_write'=>$date,
           ]);
           if($request->input('review'.$inv->product_id)==''){
            $request->validate([
                'review'.$inv->product_id=>'required',
            ]);
        }
            $review->save();
        }
        $invoice=Invoice::find($request->id);
        $invoice->status=4;
        $invoice->save();
        return Redirect::route('invoice.index')->withErrors(['success' => 'Thank you for rating the order '.$request->id]);
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
        if($invoice->status!=2||$invoice->username!=Auth::user()->username){
            return Redirect::back();
        }
        $day=substr($invoice->id,6,2);
            $month=substr($invoice->id,4,2);
            $year=substr($invoice->id,0,4);
            $hour=substr($invoice->id,8,2);
            $minute=substr($invoice->id,10,2);
            $second=substr($invoice->id,12,2);
            $detail=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;
        $invoicedetail=InvoiceDetail::select('product_details.id','image','name','capacity')
        ->join('product_details','product_details.id','=','invoice_details.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('invoice_id','=',$id)->get();
        foreach($invoicedetail as $inv){
            $inv->image=Storage::url($inv->image);
        }
        return view('review',['invoicedetail'=>$invoicedetail,'invoice'=>$invoice,'detail'=>$detail]);
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
