<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id_empresa';
    protected $fillable = ['nombre', 'nit', 'direccion', 'telefono', 'correo', 'contacto_nombre', 'contacto_telefono', 'contacto_correo', 'iva_producto', 'iva_servicio'];
}
