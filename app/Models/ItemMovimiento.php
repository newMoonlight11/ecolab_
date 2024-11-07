<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemMovimiento
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $cantidad
 * @property $reactivo_id
 * @property $movimiento_id
 *
 * @property Movimiento $movimiento
 * @property Reactivo $reactivo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ItemMovimiento extends Model
{
    
    use HasFactory;
    protected $table = 'item_movimiento';

    protected $fillable = ['cantidad', 'ubicacion', 'codigoUNAB', 'fechaVencimiento', 'reactivo_id', 'movimiento_id', 'laboratorio_id', 'unidad_id'];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class, 'movimiento_id');
    }

    public function reactivo()
    {
        return $this->belongsTo(Reactivo::class, 'reactivo_id');
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'laboratorio_id');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }
    
}
