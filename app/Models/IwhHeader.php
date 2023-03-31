<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IwhHeader extends Model
{
    use HasFactory;
    protected $table = "invwh_header";
    protected $fillable = ['idp','kd_inv','term','tipe','jumlah','kd_vsl','container','tgl_gen',
                            'inv_cr','inv_memo','manifest_id'];

    public function kapal()
    {
        //return $this->belongsTo('App\Vessel','vessel_id');
        //return $this->belongsTo('App\Vessel','kd_vsl');   
        return $this->belongsTo(Vessel::class,'kd_vsl','kd_vsl');
    }    

    public function cnee()
    {
        return $this->hasOne(Manifest::class,'kd_inv','kd_inv'); 
    }
}
