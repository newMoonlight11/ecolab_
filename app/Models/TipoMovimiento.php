<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    use HasFactory;

    protected $table = 'tipo_movimiento';

    protected $fillable = [];

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'tipo_movimiento');
    }
}
