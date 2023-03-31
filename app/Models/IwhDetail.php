<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IwhDetail extends Model
{
    use HasFactory;
    protected $table = "invwh_detail";
    protected $fillable = ['idp','kd_inv','tipe','term','kd_vsl','kd_tarif',
                            'nama_tarif','tarif','weight','measure', 'vol_actual','wm','jumlah','ppn',
                            'container','is_adm','manifest_id'];
                            
    public function tarif()
    {
        return $this->hasMany(Tarif::class,'kd_item','kd_item');        
    }        
}
