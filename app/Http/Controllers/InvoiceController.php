<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice=Invoice::where('username','like',Auth::user()->username)->get();
        $date=array();
        $status=array();
        foreach($invoice as $inv){
            $day=substr($inv->id,6,2);
            $month=substr($inv->id,4,2);
            $year=substr($inv->id,0,4);
            $hour=substr($inv->id,8,2);
            $minute=substr($inv->id,10,2);
            $second=substr($inv->id,12,2);
            $date[$inv->id]=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;


            if($inv->status==0){
                $status[$inv->id]='Waiting for confirmation';
            }else if($inv->status==1){
                $status[$inv->id]='Being shipped';
            }else if($inv->status==2||$inv->status==4){
                $status[$inv->id]='Delivered';
            }else{
                $status[$inv->id]='Cancelled';
            }
        }
        return view('invoice',['invoice'=>$invoice,'date'=>$date,'status'=>$status]);
        
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
            'phone'=>'bail|required|numeric|digits:10',
            'address'=>'required'
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
            'username'=>Auth::user()->username,
            'shipping_address'=>$request->address,
            'shipping_phone'=>$request->phone,
            'status'=>0,
        ]);
        $invoice->save();
        $product=Cart::select('product_details.id','price','quantity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->where('username','like',Auth::user()->username)->get();
        foreach ($product as $pd) {
            $invdetail=new InvoiceDetail();
            $invdetail->fill([
                'invoice_id'=>$id,
                'product_id'=>$pd->id,
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
        $detail=array();
        $invoice=Invoice::find($id);
        $detail[0]=$invoice->status;
        if($invoice->username!=Auth::user()->username){
            return Redirect::action([InvoiceController::class,'index']);
        }
        if($invoice->status==0){
            $invoice->status='Waiting for confirmation';
        }else if($invoice->status==1){
            $invoice->status='Being shipped';
        }else if($invoice->status==2||$invoice->status==4){
            $invoice->status='Delivered';
        }else{
            $invoice->status='Cancelled';
        }
        $invoicedetail=InvoiceDetail::select('product_details.id','image','name','invoice_details.price','invoice_details.quantity','capacity')
        ->join('product_details','product_details.id','=','invoice_details.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('invoice_id','=',$id)->get();
        $total=0;
        $day=substr($invoice->id,6,2);
        $month=substr($invoice->id,4,2);
        $year=substr($invoice->id,0,4);
        $hour=substr($invoice->id,8,2);
        $minute=substr($invoice->id,10,2);
        $second=substr($invoice->id,12,2);
        $detail[1]=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;
        foreach($invoicedetail as $inv){
            $total+=$inv->price*$inv->quantity;
            $inv->image=Storage::url($inv->image);
        }
        return view('invoicedetail',['invoicedetail'=>$invoicedetail,'total'=>$total,'invoice'=>$invoice,'detail'=>$detail]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lstInvoice=Invoice::find($id);
        if($lstInvoice->status==5){
            $lstInvoice->status=4;
            $lstInvoice->save();
            return Redirect::route('invoice.invoice_index');
        }else{
            $lstInvoice->status+=1;
            $lstInvoice->save();
            return redirect()->back();
        }
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

    public function invoiceAdmin()
    {
        if(isset($_GET['status'])&&$_GET['status']!=null){
            $lstInvoice = Invoice::where('status','=',$_GET['status'],'and')->where('type','=',0)->paginate(10);
        }else{
            $lstInvoice = Invoice::where('status','=',0,'and')->where('type','=',0)->paginate(10);
        }
        $pending=Invoice::where('status','=',0,'and')->where('type','=',0)->count();
        $toship=Invoice::where('status','=',1,'and')->where('type','=',0)->count();
        $toreceive=Invoice::where('status','=',2,'and')->where('type','=',0)->count();
        $complete=Invoice::where('status','=',3,'and')->where('type','=',0)->count();
        $cancel=Invoice::where('status','=',5,'and')->where('type','=',0)->count();
        $canceled=Invoice::where('status','=',4,'and')->where('type','=',0)->count();
        //return view('Invoice.Invoice',['lstHoaDon'=>$lstHoaDon,'pending'=>$pending,'toship'=>$toship,'toreceive'=>$toreceive,'complete'=>$complete,'cancel'=>$cancel,'canceled'=>$canceled]);
        
        //$lstInvoice = Invoice::all();
        return view('invoice.invoice_index',['lstInvoice'=>$lstInvoice,'pending'=>$pending,'toship'=>$toship,'toreceive'=>$toreceive,'complete'=>$complete,'cancel'=>$cancel,'canceled'=>$canceled]);
        
    }

    public function huy($id)
    {
        $lstInvoice=Invoice::find($id);
        $lstInvoice->status=0;
        $lstInvoice->save();
        return Redirect::route('invoice.invoice_index');
    }

    public function showInvoiceAdmin($id)
    {
        $invoice=Invoice::find($id);
        if($invoice->status==0){
            $invoice->status='Waiting for confirmation';
        }else if($invoice->status==1){
            $invoice->status='Being shipped';
        }else if($invoice->status==2){
            $invoice->status='Receive';
        }else if($invoice->status==3){
            $invoice->status='Complete';
        }else if($invoice->status==4){
            $invoice->status='Cancel';
        }else{
            $invoice->status='Cancelled';
        }
        $invoicedetail=InvoiceDetail::select('product_details.id','image','name','invoice_details.price','invoice_details.quantity','capacity')
        ->join('product_details','product_details.id','=','invoice_details.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('invoice_id','=',$id)->get();
        $total=0;
        $day=substr($invoice->id,6,2);
        $month=substr($invoice->id,4,2);
        $year=substr($invoice->id,0,4);
        $hour=substr($invoice->id,8,2);
        $minute=substr($invoice->id,10,2);
        $second=substr($invoice->id,12,2);
        $date=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;
        foreach($invoicedetail as $inv){
            $total+=$inv->price*$inv->quantity;
            $inv->image=Storage::url($inv->image);
        }
        return view('invoice.invoice_show',['invoicedetail'=>$invoicedetail,'total'=>$total,'invoice'=>$invoice,'date'=>$date]);
    }

    public function hoadonnhap()
    {
        $lstInvoice = Invoice::where('type','=',1)->paginate(10);
        return view('receipt.receipt_index',['lstInvoice'=>$lstInvoice]);
    }

    public function chitietnhap($id){
        $InvoiceDetail=Invoice::find($id);
        if($InvoiceDetail->status==0){
            $InvoiceDetail->status='Waiting for confirmation';
        }else if($InvoiceDetail->status==1){
            $InvoiceDetail->status='Being shipped';
        }else{
            $InvoiceDetail->status='Delivered';
        }

        $lstInvoiceDetail=InvoiceDetail::select('product_details.id','image','name','invoice_details.price','invoice_details.quantity','capacity','invoice_id')
        ->join('product_details','product_details.id','=','invoice_details.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('invoice_id','=',$id)->get();

        $total=0;
        $day=substr($InvoiceDetail->id,6,2);
        $month=substr($InvoiceDetail->id,4,2);
        $year=substr($InvoiceDetail->id,0,4);
        $hour=substr($InvoiceDetail->id,8,2);
        $minute=substr($InvoiceDetail->id,10,2);
        $second=substr($InvoiceDetail->id,12,2);
        $date=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;
        foreach($lstInvoiceDetail as $inv){
            $total+=$inv->price*$inv->quantity;
            $inv->image=Storage::url($inv->image);
        }
        return view('receipt.receipt_show',['lstInvoiceDetail'=>$lstInvoiceDetail,'total'=>$total,'InvoiceDetail'=>$InvoiceDetail,'date'=>$date]);
    }

    public function themhdnhap()
    {
        $pd = Product::all();
        $pddt = ProductDetail::all();
        $invoice = Invoice::all();
        // return $pddt[0]->product_id;
        // return $pd[0]->id;
        return view('receipt.receipt_add',['pd'=>$pd,'invoice'=>$invoice,'pddt'=>$pddt]);
    }

    public function xulihdnhap(Request $request)
    {
        $year =  Carbon::now('Asia/Ho_Chi_Minh')->year;
        $month = (int)Carbon::now('Asia/Ho_Chi_Minh')->month;
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
        if( $month < 10) 
        {
            $month = '0'.$month;
        }
        $day = (int)Carbon::now('Asia/Ho_Chi_Minh')->day;
        
        if($day < 10)
        {
            $day = '0'.$day;
        }
        $id = $year.$month.$day.$hour.$minute.$second;
        $invoice = new Invoice;
        $invoice->fill([
         'id' => $id,
         'username' => 'ADMIN',
         'shipping_address' => 'Huynh Thuc Khang, Quan 1',
         'shipping_phone' => '0123456789',
         'type'=>1, //hóa đơn nhập
         'status'=>0
        ]);
        $invoice->save();

        $invoicedetail=new InvoiceDetail;
        $invoicedetail->fill([
            'invoice_id'=>$id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
        ]);
        $invoicedetail->save();

        $productDetail=ProductDetail::find($request->product_id);
        $productDetail->stock+=$request->quantity;
        $productDetail->save();
        return Redirect::route('receipt');
    }


}
