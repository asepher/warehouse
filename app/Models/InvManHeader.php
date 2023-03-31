<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvManHeader extends Model
{
    use HasFactory;
    protected $table = "invman_header";
    protected $guarded = [];    
}
