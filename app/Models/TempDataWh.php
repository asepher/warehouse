<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDataWh extends Model
{
    use HasFactory;
    protected $table = "tempdatawh";
    protected $guarded = [];
    /*
    protected $fillable =  ['no_master_bl',
                            'tgl_master_bl',
                            'no_host_bl'];
    */
   
}
