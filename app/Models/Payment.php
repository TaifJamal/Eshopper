<?php

namespace App\Models;


use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
   use HasFactory, SoftDeletes;
   protected $guarded = [];

   public function User()
   {
      return $this->belongsTo(User::class)->withDefault();
   }

   public function Order()
   {
      return $this->belongsTo(Order::class)->withDefault();
   }


}
