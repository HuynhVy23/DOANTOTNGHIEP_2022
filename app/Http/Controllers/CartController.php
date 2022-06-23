<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductDetail;
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
