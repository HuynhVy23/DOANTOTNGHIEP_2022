<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Sale;
use App\Models\Scent;
use Carbon\Carbon;

class ProductController extends Controller
{
     

    public function fixImage(Product $pd){
        if(Storage::disk('public')->exists($pd->image)){
            $pd->image=Storage::url($pd->image);
        }else{
            $pd->image='/image/auto.jpg';
        }
    }

    public function fixImageBrand(Brand $br){
        if(Storage::disk('public')->exists($br->image_brand)){
            $br->image_brand=Storage::url($br->image_brand);
        }else{
            $br->image_brand='/image/brand/auto.jpg';
        }
    }

    public function fixImageSale(Sale $sale){
        if(Storage::disk('public')->exists($sale->image_banner)){
            $sale->image_banner=Storage::url($sale->image_banner);
        }else{
            $sale->image_banner='/image/brand/auto.jpg';
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

        $sex = array();
        foreach($lstProduct as $gen){
            if($gen->gender == 0){
                $sex[$gen->id] = "Male";
            }else if($gen->gender == 1){
                $sex[$gen->id] = "Female";
            }else{
                $sex[$gen->id] = "Unisex";
            }
        }
        return view('product.product_index',['lstProduct'=>$lstProduct,'sex'=>$sex]);
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
        $pd=Product::all();
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
            'name'=>'bail|required',
            'concentration'=>'bail|required|',
            'description'=>'bail|required',
            'gender'=>'bail|required',
            'brand_id'=>'required',
            'scent_id'=>'bail|required'
        ]);
        $product=new Product();

        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'gender'=>$request->input('gender'),
            'image'=>'',
            'brand_id'=>$request->input('brand_id'),
            'scent_id'=>$request->input('scent_id'),
        ]);

        $product->save();
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('img/product/'.$product->id,'public');
        }
        else{
            $product->image='image/auto.jpg';
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

        if($product->gender==0){
            $product->gender='Male';
        }else if($product->gender==1){
            $product->gender='Female';
        }else{
            $product->gender='Unisex';
        }
        
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
        $request->validate([
            'name'=>'bail|required',
            'concentration'=>'bail|required|',
            'description'=>'bail|required',
            'gender'=>'bail|required',
            'brand_id'=>'required',
            'scent_id'=>'bail|required'
        ]);
        $product=Product::find($id);
        if($request->hasFile('image')){
            $product->image=$request->file('image')->store('img/product/'.$product->id,'public');
        }
        $product->fill([
            'name'=>$request->input('name'),
            'concentration'=>$request->input('concentration'),
            'description'=>$request->input('description'),
            'gender'=>$request->gender,
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
        $sort=isset($_GET['sort'])?$_GET['sort']:'';
        $name=isset($_GET['name'])?$_GET['name']:'';
        $column='id';
        $type='asc';
        if($sort=='az'){
            $column='name';
        }else if($sort=='za'){
            $column='name';
            $type='desc';
        }
        if($name!=''){
            $lstProduct= Product::where('name','like','%'.$name.'%')->orderBy($column,$type)->paginate(1);
        }else{
            $lstProduct= Product::orderBy($column,$type)->paginate(9);
        }
        foreach($lstProduct as $pd){
            $this->fixImage($pd);
        }
        $brand=Brand::all();
        $scent=Scent::all();
        $pagination = $lstProduct->appends(array('value' => 'key'));
        return view('product',['lstProduct'=>$lstProduct,'brand'=>$brand,'pagination' => $pagination,'scent'=>$scent]);
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
        $date=Carbon::now()->toDateString();
        $lstSale=Sale::where('date_start','<=',$date)
        ->where('date_end','>=',$date)->get();
        foreach($lstSale as $s){
            $this->fixImageSale($s);
        }
        $lstScent=Scent::all();
        return view('index',['lstProduct'=>$lstProduct,'brand'=>$lstBrand,'scent'=>$lstScent,'lstSale'=>$lstSale]);
    }

    public function gender($id)
    {
        if($id==0){
            $title="Men";
        }elseif($id==1){
            $title="Women";
        }else{
            $title="Unisex";
        }
        $lstProduct=Product::where('gender','=',$id)->get();
        foreach($lstProduct as $p){
            $p->image=Storage::url($p->image);
        }
        return view('scent',['title'=>$title,'lstProduct'=>$lstProduct]);
    }
}
