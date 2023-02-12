<?php

namespace App\Models;


use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
   use HasFactory, SoftDeletes;
   protected $guarded = [];

   public function User()
   {
      return $this->belongsTo(User::class)->withDefault();
   }

   public function orderItems()
   {
     return $this->hasMany(orderItem::class);
   }

   public function Payment()
   {
       return $this->hasMany(Payment::class);
   }

}
