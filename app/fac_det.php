<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fac_det extends Model
{
  protected $table = 'fac_det';
  protected $primaryKey = 'id_fac_det';
  protected $fillable = ['id_producto','cantidad'];
}
