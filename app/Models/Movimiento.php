<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $fillable = ['fecha_movimiento', 'descripcion', 'tipo_movimiento'];

    public function tipoMovimiento()
    {
        return $this->belongsTo(TipoMovimiento::class, 'tipo_movimiento');
    }

    public function items()
    {
        return $this->hasMany(ItemMovimiento::class, 'movimiento_id');
    }
}

