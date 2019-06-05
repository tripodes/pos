<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fac_enc extends Model
{
    protected $table = 'fac_enc';
    protected $primaryKey = 'id_fac_enc';
    protected $fillable = ['serie','numero','id_cliente'];
}
