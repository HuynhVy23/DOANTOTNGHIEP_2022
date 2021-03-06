<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\ProductDetail;
use Carbon\Carbon;
use DateTime;

class SaleController extends Controller
{
    public function fixImage(Sale $sale){
        if(Storage::disk('public')->exists($sale->image_banner)){
            $sale->image_banner = Storage::url($sale->image_banner);
        }else{
            $sale->image_banner='/image/auto.jpg';
        }
    }
    public function fixImageSaleDetail(SaleDetail $sd){
        if(Storage::disk('public')->exists($sd->image)){
            $sd->image=Storage::url($sd->image);
        }else{
            $sd->image='/image/auto.jpg';
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
        // return $lstSale;
        $date= array();
        $dateEnd = array();
        foreach($lstSale as $sale){
            $date[$sale->id] = $sale->date_start->toDateString();
            $dateEnd[$sale->id] = $sale->date_end->toDateString();
            $this->fixImage($sale);
        }
        return view('sale.sale_index',['lstSale'=>$lstSale,'date'=>$date,'dateEnd'=>$dateEnd]);
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
        // return $request;
        $request->validate([
            'name'=>'bail|required',
            'date_start'=>'required|date',
            'date_end'=>'required|date|after_or_equal:date_start ',
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
        $request->validate([
            'name'=>'bail|required',
            'date_start'=>'required|date',
            'date_end'=>'required|date|after_or_equal:date_start ',
        ]);
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

    public function showsale($id)
    {
        $sale=Sale::find($id);
        $datetime=Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        if($sale->date_start>=$datetime&&$sale->date_end<=$datetime){
            return Redirect::back();
        }
        $lstSaleDetail=SaleDetail::select('products.id as id','products.image','products.name','products.description')
        ->join('product_details','product_details.id','=','sale_details.product_detail_id')
        ->join('products','products.id','=','product_details.product_id')
        ->where('sale_id','=',$sale->id)
        ->distinct('products.id')
        ->get();
        foreach ($lstSaleDetail as $sd) {
            $this->fixImageSaleDetail($sd);
        }
        $title[0]="Promotions";
        $title[1]=$sale->name;
        return view('scent',['title'=>$title,'lstProduct'=>$lstSaleDetail]);
    }
}
