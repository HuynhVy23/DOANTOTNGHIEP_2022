<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductDetail;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if(!Auth::check()){
            return response()->json(['status'=>3]);
        }
      $id=$request->idproduct;
      $quantity=$request->input('quantity');
      $username=Auth::user()->username;
      $productincart=Cart::where('username','=',$username)->where('product_id','=',$id)->first();
      if($productincart==null){
        $cart=new Cart();
        $cart->fill([
            'username'=>$username,
            'product_id'=>$id,
            'quantity'=>$quantity,
        ]);
        $cart->save();
      }else{
        $stock=ProductDetail::where('id','=',$id)->value('stock');
        if($quantity+$productincart->quantity>$stock){
            $productincart->quantity=$stock;
            return response()->json(['status'=>0]);
            // return Redirect::back()->withErrors(['status'=>0,'fail' =>"No...No...No...Can't buy more than stock."]);
            //Thông báo lỗi
        }else{
            $productincart->quantity+=$quantity;
            $productincart->save();
        }
      }
      return response()->json(['status'=>1]);
    //    return Redirect::back()->withErrors([,'success' => 'Added the product to the cart.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        
    }

    public function fixImage($pd){
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/auto.jpg';
        }
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
        
    }

    public function delete($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return response()->json(['status'=>1]);;
    }

    public function updatecart(Request $request)
    {
        $cart=Cart::where('username','like',Auth::user()->username)->where('product_id','=',$request->idproduct)->first();
        $stock=ProductDetail::where('id','=',$request->idproduct)->first();
        if($request->quantity>0&&$request->quantity<=$stock->stock){
            $cart->quantity=$request->quantity;
            $cart->save();
        }
        return response()->json(['status'=>$cart->quantity]);;
    }

    public function showcart()
    {
        $product=Cart::select('product_details.id','image','name','price','stock','quantity','capacity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('username','like',Auth::user()->username)
        ->where('stock','>',0)->get();
        $soldout=Cart::select('product_details.id','image','name','price','stock','quantity','capacity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('username','like',Auth::user()->username)
        ->where('stock','=',0)->get();
        foreach($product as $pd){
            $this->fixImage($pd);
        }
        $datetime=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $total=0;
        foreach($product as $pd){
            $sale=SaleDetail::select('product_detail_id','price_sale')
            ->join('sales','sales.id','sale_details.sale_id')
            ->where('product_detail_id','=',$pd->id)
            ->where('date_start','<=',$datetime)
            ->where('date_end','>=',$datetime)->first();
            if($sale!=''){
                $pd->price=$sale->price_sale;
            }
            $total+=$pd->price*$pd->quantity;
        }
        $user=User::find(Auth::user()->id);
        return view('cart',['product'=>$product,'total'=>$total,'user'=>$user,'soldout'=>$soldout]);
    }
}
