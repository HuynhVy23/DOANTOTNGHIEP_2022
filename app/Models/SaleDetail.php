<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded=[];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    // public function productDetail(){
    //     return $this->belongsTo(ProductDetail::class);
    // }

    public function detail()
    {
       return $this->belongsTo(ProductDetail::class,'product_detail_id','id');
    }
}
