<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $datetime='';
    public function fixImage($pd){
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/auto.jpg';
        }
    }

    public Collection $product;

    protected $listeners = ['deleteCart'=>'deleteCart'];

    public function render()
    {
        $cart=Cart::select('product_details.id','image','name','price','stock','quantity','capacity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('username','like',Auth::user()->username)->get();
        $this->product=$cart;
        foreach($this->product as $pd){
            $this->fixImage($pd);
        }
        $this->datetime=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $total=0;
        foreach($this->product as $pd){
            $sale=SaleDetail::select('product_detail_id','price_sale')
            ->join('sales','sales.id','sale_details.sale_id')
            ->where('product_detail_id','=',$pd->id)
            ->where('date_start','<=',$this->datetime)
            ->where('date_end','>=',$this->datetime)->first();
            if($sale!=''){
                $pd->price=$sale->price_sale;
            }
            $total+=$pd->price*$pd->quantity;
        }
        $user=User::find(Auth::user()->id);
        // return view('cart',['product'=>$product,'total'=>$total,'user'=>$user]);
        return view('livewire.cart.index', [compact($this->product),'total'=>$total,'user'=>$user]);
    }
    public function deleteCart($id)
    {
        Cart::find($id)->delete();
		// mình thêm cái này vào để khi delete xong, nó sẽ emit đến component view, nhằm mục đích show msg và không load lại trang
        // $this->emit('alert', [
        //     'success',
        //     'Delete product success.'
        // ]);
        $cart=Cart::select('product_details.id','image','name','price','stock','quantity','capacity','carts.id as cart')
        ->join('product_details','product_details.id','=','carts.product_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('username','like',Auth::user()->username)->get();
        $this->product=$cart;
        foreach($this->product as $pd){
            $this->fixImage($pd);
        }
        $this->datetime=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $total=0;
        foreach($this->product as $pd){
            $sale=SaleDetail::select('product_detail_id','price_sale')
            ->join('sales','sales.id','sale_details.sale_id')
            ->where('product_detail_id','=',$pd->id)
            ->where('date_start','<=',$this->datetime)
            ->where('date_end','>=',$this->datetime)->first();
            if($sale!=''){
                $pd->price=$sale->price_sale;
            }
            $total+=$pd->price*$pd->quantity;
        }
    }
}
