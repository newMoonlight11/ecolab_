<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMovimiento
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Movimiento[] $movimientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoMovimiento extends Model
{
    
    use HasFactory;
    protected $table = 'tipo_movimiento';
    protected $fillable = ['nombre'];

    public function movimientos()
    {
        return $this->hasMany(\App\Models\Movimiento::class,'tipo_movimiento');
    }
    
}
