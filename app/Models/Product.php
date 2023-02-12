<?php

namespace App\Models;


use App\Models\Review;
use App\Models\Category;
use App\Models\orderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
   use HasFactory, SoftDeletes;
   protected $guarded = [];

   public function Category()
   {
      return $this->belongsTo(Category::class)->withDefault();
   }

   public function Reviews()
   {
     return $this->hasMany(Review::class);
   }

   public function Carts()
   {
     return $this->hasMany(Cart::class);
   }

   public function orderItems()
   {
     return $this->hasMany(orderItem::class);
   }


}
