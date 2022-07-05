<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function fixImage(Brand $brand){
        if(Storage::disk('public')->exists($brand->image_brand)){
            $brand->image_brand = Storage::url($brand->image_brand);
        }else{
            $brand->image_brand='/image/brand/auto.jpg';
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchBrand = $request['searchBrand'] ?? "";
        if($searchBrand != ""){
            $lstBrand = Brand::where('name_brand', 'LIKE',"%$searchBrand%")->get();
        }else{
            $lstBrand = Brand::all();
        }
        
        foreach($lstBrand as $brand){
            $this->fixImage($brand);
        }
        return view('brand.brand_index',['lstBrand'=>$lstBrand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstBrand=Brand::all();
        return view('brand.brand_add')->with('lstBrand',$lstBrand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_brand'=>'bail|required|',
            'detail'=>'bail|required|',
        ]);
        $lstBrand = new Brand;
        $lstBrand->fill([
            'name_brand'=>$request->input('name_brand'),
            'detail'=>$request->input('detail'),
            'image_brand'=>'',
        ]);
        $lstBrand->save();
        if ($request->hasFile('image_brand')) {
            $lstBrand->image_brand = $request->file('image_brand')->store('img/brand/' . $lstBrand->id, 'public');
        }
        $lstBrand->save();
        return Redirect::route('brand.index',['lstBrand'=>$lstBrand]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lstBrand=Brand::find($id);
        $this->fixImage($lstBrand);
        return view('brand.brand_update',['lstBrand'=>$lstBrand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_brand'=>'bail|required|',
            'detail'=>'bail|required|',
        ]);
        $lstBrand=Brand::find($id);
        if($request->hasFile('image_brand')){
            $lstBrand->image_brand=$request->file('image_brand')->store('img/brand/' . $lstBrand->id, 'public');
        }
        $lstBrand->fill([
            'name_brand'=>$request->input('name_brand'),
            'detail'=>$request->input('detail'),

        ]);
        $lstBrand->save();
        return Redirect::route('brand.index',['lstBrand'=>$lstBrand]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lstBrand=Brand::find($id);
        $lstBrand->delete();
        return Redirect::route('brand.index');
    }

    public function brand()
    {
        $lstBrand=Brand::paginate(9);
        foreach($lstBrand as $br){
            $this->fixImage($br);
        }
        return view('brand',['brand'=>$lstBrand]);
    }

    public function showbrand($id)
    {
        $brand=Brand::find($id);
        $brand->detail=explode('.',$brand->detail);
        $brand->image_brand=Storage::url($brand->image_brand);
        $product=Product::where('brand_id','=',$id)->get();
        foreach($product as $p){
            $p->image=Storage::url($p->image);
        }
        return view('branddetail',['brand'=>$brand,'product'=>$product]);
    }

    
}
