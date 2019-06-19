<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['descripcion', 'id_categoria', 'id_marca', 'lote', 'precio_venta', 'existecia', 'activo'];
}
