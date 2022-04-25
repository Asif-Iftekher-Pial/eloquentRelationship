<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','category_id','description'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function productsbysubcat(){
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
}
