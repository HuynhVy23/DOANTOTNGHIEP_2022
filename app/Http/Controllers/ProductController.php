<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Scent;

class ProductController extends Controller
{
    public function fixImage(Product $pd){
        if(Storage::disk('public')->exists($pd->hinh_anh)){
            $pd->hinh_anh=Storage::url($pd->hinh_anh);
        }else{
            $pd->hinh_anh='/image/product/auto.jpg';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstProduct=Product::all();
        foreach($lstProduct as $pd){
            $this->fixImage($pd);
        }
        return view('product.product_index',['lstProduct'=>$lstProduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstBrand=Brand::all();
        $lstScent=Scent::all();
        return view('product.product_add',['lstBrand'=>$lstBrand],['lstScent'=>$lstScent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new Product();

        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'hinh_anh'=>'',
            'brand_id'=>$request->input('brand_id'),
            'scent_id'=>$request->input('scent_id'),
        ]);

        $product->save();
        if($request->hasFile('hinh_anh')){
            $product->hinh_anh=$request->file('hinh_anh')->store('img/product/'.$product->id,'public');
        }

        $product->save();
        return Redirect::route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $lstBrand=Brand::all();
        $lstScent=Scent::all();
        $this->fixImage($product);
        return view('product.product_update',['product'=>$product,'lstBrand'=>$lstBrand],['product'=>$product,'lstScent'=>$lstScent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        if($request->hasFile('hinh_anh')){
            $product->hinh_anh=$request->file('hinh_anh')->store('img/product/'.$product->id,'public');
        }
        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'brand_id'=>$request->input('brand_id'),
            'scent_id'=>$request->input('scent_id'),
        ]);
        
        $product->save();
        return Redirect::route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return Redirect::route('product.index');
    }
}
