<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
   protected $table = "tarif";
    protected $fillable = ['kd_tarif','nama_tarif', 'jumlah', 'term' ,'ppn'];    
}
