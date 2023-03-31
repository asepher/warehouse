<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
   use HasFactory;
   protected $table = "vessel";
   //protected $fillable = ['kd_vsl','eta','vessel','container','vls_bl','jum_pos',
   //                  'inv3','last_num','last_dn','gen_dn'] ;    
   protected $guarded = [];
}
