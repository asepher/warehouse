<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtLog extends Model
{
    use HasFactory;
    protected $table = "db_log";
    protected $guarded = [];
}
