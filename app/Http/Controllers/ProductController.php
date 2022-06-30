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
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/product/auto.jpg';
        }
    }

    public function fixImageBrand(Brand $br){
        if(Storage::disk('public')->exists($br->image)){
            $br->image=Storage::url($br->image);
        }else{
            $br->image='/image/brand/auto.jpg';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $search = $request['search'] ?? "";
        if($search != ""){
            $lstProduct = Product::where('name', 'LIKE',"%$search%")->orWhere('concentration', 'LIKE',"%$search%")->get();
        }else{
            $lstProduct=Product::all();
            
        }
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
        $request->validate([
            'name'=>'bail|required|alpha_dash|between:4,50',
            'concentration'=>'bail|required|',
            'description'=>'bail|required',
            'brand_id'=>'required',
            'scent_id'=>'bail|required'
        ]);
        $product=new Product();

        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'image'=>'',
            'brand_id'=>$request->input('brand_id'),
            'scent_id'=>$request->input('scent_id'),
        ]);

        $product->save();
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('img/product/'.$product->id,'public');
        }

        $product->save();
        return Redirect::route('productad.index');
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
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('img/product/'.$product->id,'public');
        }
        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'brand_id'=>$request->input('brand_id'),
            'scent_id'=>$request->input('scent_id'),
        ]);
        
        $product->save();
        return Redirect::route('productad.index');
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
        return Redirect::route('productad.index');
    }

    public function product()
    {
        $lstProduct=Product::paginate(9);
        foreach($lstProduct as $pd){
            $this->fixImage($pd);
        }
        $brand=Brand::all();
        $scent=Scent::all();
        return view('product',['lstProduct'=>$lstProduct,'brand'=>$brand,'scent'=>$scent]);
    }

    public function indexUser()
    {
        $lstBrand=Brand::take(3)->get();
        foreach($lstBrand as $br){
            $this->fixImageBrand($br);
        }
        $lstProduct=Product::take(6)->get();
        foreach($lstProduct as $pd){
            $this->fixImage($pd);
        }
        return view('index',['lstProduct'=>$lstProduct,'brand'=>$lstBrand]);
    }
}
