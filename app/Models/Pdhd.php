<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pdhd extends Model
{
    use HasFactory;
    protected $table = 'pdhd';
    protected $guarded = [];

    public function getAllPdhd()
    {
        $result = DB::table('pdhd')
        ->select('id','kd_pd','tanggal','customer','jumlah')
        ->get()->toArray();        
        return $result;
    }
}
