<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvSiHeader extends Model
{
    use HasFactory;
    protected $table = 'invsi_header';
    protected $guarded = [];    
    
    public function shipping()
    {
        return $this->belongsTo(Shipping::class,'kd_si','kd_si');
    }        
    public function customer()
    {
        return $this->belongsTo(Customer::class,'kd_cus','kd_cus');
    }        
}
 