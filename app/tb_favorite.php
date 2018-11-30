<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_favorite extends Model
{
    protected $fillable = [
        'id_user','id_data_jasa',
    ];
}
