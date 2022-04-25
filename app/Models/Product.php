<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','description','price','subcategory_id','thumbnail'
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }

}
