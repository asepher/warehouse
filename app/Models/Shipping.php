<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = 'shipping';
    protected $guarded = [];

      public function nmcnee()
   {
      return $this->belongsTo(Customer::class,'kd_cus','kd_cus');
   }
      
}
