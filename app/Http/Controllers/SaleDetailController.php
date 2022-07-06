<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstSaleDetail = SaleDetail::all();
        return view('sale_detail.sale_detail_index',['lstSaleDetail'=>$lstSaleDetail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lstSale=Sale::all();
        $lstProductDetail=ProductDetail::all();
        return view('sale_detail.sale_detail_add',['lstSale'=>$lstSale],['lstProductDetail'=>$lstProductDetail]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sale_id'=>'bail|required',
            'product_detail_id'=>'bail|required',
            'price_sale'=>'bail|required',
        ]);
        $saleDetail = new SaleDetail;
        $saleDetail->fill([
            'sale_id'=>$request->input('sale_id'),
            'product_detail_id'=>$request->input('product_detail_id'),
            'price_sale'=>$request->input('price_sale'),
        ]);
        $saleDetail->save();
        return Redirect::route('sale_detailad.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleDetail=SaleDetail::find($id);
        $lstProductDetail=ProductDetail::all();
        $lstSale=Sale::all();
        return view('sale_detail.sale_detail_update',['saleDetail'=>$saleDetail,'lstProductDetail'=>$lstProductDetail,'lstSale'=>$lstSale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $saleDetail=SaleDetail::find($id);
        $request->validate([
            'sale_id'=>'bail|required',
            'product_detail_id'=>'bail|required',
            'price_sale'=>'bail|required',
        ]);
        $saleDetail->fill([
            'sale_id'=>$request->input('sale_id'),
            'product_detail_id'=>$request->input('product_detail_id'),
            'price_sale'=>$request->input('price_sale'),
        ]);
        
        $saleDetail->save();
        return Redirect::route('sale_detailad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saleDetail=SaleDetail::find($id);
        $saleDetail->delete();
        return Redirect::route('sale_detailad.index');
    }
}
