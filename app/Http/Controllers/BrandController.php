<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstBrand = Brand::all();
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
        $lstBrand = new Brand;
        $lstBrand->fill([
            'name_brand'=>$request->input('name_brand'),
        ]);
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
        $lstBrand=Brand::find($id);
        $lstBrand->fill([
            'name_brand'=>$request->input('name_brand'),
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
}