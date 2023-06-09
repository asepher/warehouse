<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
   use HasFactory;
   protected $table = "manifest";
   protected $guarded = [];
                     
   public function nmcustomer()
   {
      return $this->belongsTo(Customer::class,'consignee','kd_cus');
   }


}
