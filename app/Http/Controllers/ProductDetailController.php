<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\SaleDetail;
use Carbon\Carbon;
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

    public function index(Request $request)
    {
        $searchDetail = $request['searchDetail'] ?? "";
        if($searchDetail != ""){
            $lstProductDetail = ProductDetail::where('capacity', 'LIKE',"%$searchDetail%")->orWhere('price', 'LIKE',"%$searchDetail%")->get();
        }else{
            $lstProductDetail = ProductDetail::all();
        }
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
        $request->validate([
            'capacity'=>'bail|required',
            'price'=>'bail|required',
            'stock'=>'bail|required',
            'product_id'=>'required',
            'status'=>'bail|required'
        ]);
        $productDetail = new ProductDetail;
        $num = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);
        $productDetail->fill([
            'capacity'=>$request->input('capacity'),
            'price'=>$num,
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
        $product=Product::select('products.name','products.image','products.description','brands.name_brand','scents.name_scent','brands.id as id_brand','scents.id as id_scent')
        ->join('brands','brands.id','=','products.brand_id')
        ->join('scents','scents.id','=','products.scent_id')
        ->where('products.id','=',$id)->get();
        $product[0]->image=Storage::url($product[0]->image);
        $productDetail=ProductDetail::where('product_id','=',$id)
        ->where('stock','>',0)
        ->get();
        $product[0]->description=explode('.', $product[0]->description );
        $review=Review::select('users.avatar','users.username','reviews.content','reviews.date_write','reviews.id')
        ->join('users','users.username','=','reviews.username')
        ->where('product_id','=',$id)->paginate(10);
        $sale=new SaleDetail();
        $datetime=Carbon::now()->toDateString();
        foreach ($productDetail as $dt) {
            $a=SaleDetail::select('product_detail_id','price_sale')
            ->join('sales','sales.id','sale_details.sale_id')
            ->where('product_detail_id','=',$dt->id)
            ->where('date_start','<=',$datetime)
            ->where('date_end','>=',$datetime)->first();
            if($a!=''){
                // $sale[$dt->id]['id']=$dt->id;
                $sale[$dt->id]=$a;
            }
        }
        // return $sale;
        // return $sale['product_detail_id'];
        $date=array();
        foreach ($review as $r) {
            $r->avatar=Storage::url($r->avatar);
            $day=substr($r->date_write,6,2);
        $month=substr($r->date_write,4,2);
        $year=substr($r->date_write,0,4);
        $hour=substr($r->date_write,8,2);
        $minute=substr($r->date_write,10,2);
        $second=substr($r->date_write,12,2);
        $date[$r->id]=$hour.":".$minute.":".$second." ".$day."-".$month."-".$year;
        }
        return view('productdetail',['product'=>$product,'detail'=>$productDetail,'all'=>$productall,'date'=>$date,'review'=>$review,'sale'=>$sale]);
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
