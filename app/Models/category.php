<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable =[
           'user_id',
    ];

    public function Products()
    {
        return $this->belongsToMany(Products::class,'category_products');
    }
     
    public function one()
    {
        return $this->hasMany(Products::class);
    }
}
