<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fixImage(Product $pd){
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/product/auto.jpg';
        }
    }

    public function index()
    {
        $lstProductDetail = ProductDetail::all();
        return view('product_detail.product_detail_index',['lstProductDetail'=>$lstProductDetail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstProduct=Product::all();
        return view('product_detail.product_detail_add')->with('lstProduct',$lstProduct);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productDetail = new ProductDetail;
        $productDetail->fill([
            'capacity'=>$request->input('capacity'),
            'price'=>$request->input('price'),
            'stock'=>$request->input('stock'),
            'product_id'=>$request->input('product_id'),
            'status'=>$request->input('status'),
        ]);
        $productDetail->save();
        return Redirect::route('product_detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productall=Product::all();
        foreach($productall as $pd){
            $this->fixImage($pd);
        }
        $product=Product::
        join('brands','brands.id','=','products.brand_id')
        ->join('scents','scents.id','=','products.scent_id')
        ->where('products.id','=',$id)->get();
        $product[0]->image=Storage::url($product[0]->image);
        $productDetail=ProductDetail::where('product_id','=',$id)
        ->where('stock','>',0)
        ->get();
        $array=explode('.', $product[0]->description );
        return view('productdetail',['product'=>$product,'detail'=>$productDetail,'all'=>$productall,'array'=>$array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productDetail=ProductDetail::find($id);
        $lstProduct=Product::all();
        return view('product_detail.product_detail_update',['productDetail'=>$productDetail,'lstProduct'=>$lstProduct]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductDetailRequest  $request
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productDetail=ProductDetail::find($id);
        $productDetail->fill([
            'capacity'=>$request->input('capacity'),
            'price'=>$request->input('price'),
            'stock'=>$request->input('stock'),
            'product_id'=>$request->input('product_id'),
            'status'=>$request->input('status'),
        ]);
        
        $productDetail->save();
        return Redirect::route('product_detail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productDetail=ProductDetail::find($id);
        $productDetail->delete();
        return Redirect::route('product_detail.index');
    }

    
}
