<?php

namespace App\Models;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class orderItem extends Model
{
   use HasFactory, SoftDeletes;
   protected $guarded = [];

   public function Product()
   {
      return $this->belongsTo(Product::class)->withDefault();
   }

   public function User()
   {
      return $this->belongsTo(User::class)->withDefault();
   }

   public function Order()
   {
      return $this->belongsTo(Order::class)->withDefault();
   }

}
