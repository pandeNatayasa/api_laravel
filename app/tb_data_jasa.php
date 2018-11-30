<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_data_jasa extends Model
{
    protected $fillable = [
        'id_kategori','id_user_admin','id_user','pekerjaan','estimasi_gaji','pengalaman_kerja','usia','no_telp','email','status','status_validasi','alamat',
    ];
}
