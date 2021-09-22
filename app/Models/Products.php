<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $primarykey ='id';

    protected $fillable = [
        'name',
        'description',
        'user_role',
        
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class,'category_products');
    }
    public function two()
    {
        return $this->belongs(category::class);
    }

}
?>