<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
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
      $id=$request->idproduct;
      $quantity=$request->input('quantity');
      $username='dinooo';
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
            return Redirect::back()->withErrors(['fail' =>"No...No...No...Can't buy more than stock."]);
            //Thông báo lỗi
        }else{
            $productincart->quantity+=$quantity;
            $productincart->save();
        }
      }
       return Redirect::back()->withErrors(['success' => 'Added the product to the cart.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $product=Cart::select('product_details.id','image','name','price','stock','quantity','capacity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('username','like',$username)->get();
        foreach($product as $pd){
            $this->fixImage($pd);
        }
        $total=0;
        foreach($product as $pd){
            $total+=$pd->price*$pd->quantity;
        }
        $user=User::find(2);
        return view('cart',['product'=>$product,'total'=>$total,'user'=>$user]);
    }

    public function fixImage($pd){
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/product/auto.jpg';
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
        return back();
    }

    
}
