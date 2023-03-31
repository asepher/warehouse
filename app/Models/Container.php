<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;
    protected $table = "container";
    //protected $fillable = ['kd_vsl','container']; 
    protected $guarded = [];    
}
