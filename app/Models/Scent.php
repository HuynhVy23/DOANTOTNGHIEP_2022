<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scent extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $primaryKey = 'id';

    public function product()
    {
       return $this->hasMany(Product::class);
    }
}
