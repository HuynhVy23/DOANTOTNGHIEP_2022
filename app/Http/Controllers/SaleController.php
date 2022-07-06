<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    public function fixImage(Sale $sale){
        if(Storage::disk('public')->exists($sale->image_banner)){
            $sale->image_banner = Storage::url($sale->image_banner);
        }else{
            $sale->image_banner='/image/auto.jpg';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstSale=Sale::all();
        foreach($lstSale as $sale){
            $this->fixImage($sale);
        }
        return view('sale.sale_index',['lstSale'=>$lstSale]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sale=Sale::all();
        return view('sale.sale_add',['sale'=>$sale]);
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
            'name'=>'bail|required',
            'date_start'=>'required',
            'date_end'=>'required',
        ]);
        $sale=new Sale();


        $sale->fill([
            'name'=>$request->input('name'),
            'date_start'=>$request->input('date_start'),
            'date_end'=>$request->input('date_end'),
            'image_banner'=>'',
        ]);

        $sale->save();
        if($request->hasFile('image_banner')){
            $sale->image_banner=$request->file('image_banner')->store('img/sale/'.$sale->id,'public');
        }
        else{
            $sale->image_banner='image/auto.jpg';
        }

        $sale->save();
        return Redirect::route('salead.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale=Sale::find($id);
        $this->fixImage($sale);
        return view('sale.sale_update',['sale'=>$sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale=Sale::find($id);
        if($request->hasFile('image_banner')){
            $sale->image_banner = $request->file('image_banner')->store('img/sale/'.$sale->id,'public');
        }
        $sale->fill([
            'name'=>$request->input('name'),
            'date_start'=>$request->input('date_start'),
            'date_end'=>$request->input('date_end'),
        ]);
        $sale->save();
        return Redirect::route('salead.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale=Sale::find($id);
        $sale->delete();
        return Redirect::route('salead.index');
    }
}
