<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function scent(){
        return $this->belongsTo(Scent::class);
    }

    public function review(){
        return $this->belongsTo(Review::class);
    }
}
