<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $guarded = [];   

    public function shipping()
    {
        return $this->hasMany(Shipping::class,'kd_cus','kd_cus');
    } 
}
