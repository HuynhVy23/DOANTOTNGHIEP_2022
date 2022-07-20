<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded=[];
    // public function totalPerfume(){
    //     return $this->hasMany(InvoiceDetail::class,'id','id_invoice');
    // }

    
}
