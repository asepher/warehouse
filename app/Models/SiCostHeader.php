<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiCostHeader extends Model
{
    use HasFactory;
    protected $table    = "cost_si_header";
    protected $guarded  = [];
}
