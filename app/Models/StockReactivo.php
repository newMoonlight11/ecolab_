<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StockReactivo
 *
 * @property $id
 * @property $fecha_stock
 * @property $cantidad_existencia
 * @property $created_at
 * @property $updated_at
 * @property $reactivo_id
 * @property $laboratorio_id
 * @property $unidad_id
 *
 * @property Laboratorio $laboratorio
 * @property Reactivo $reactivo
 * @property Unidad $unidad
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StockReactivo extends Model
{
    
    protected $perPage = 20;

    use HasFactory;
    protected $table = 'stock_reactivos';
    protected $fillable = ['fecha_stock', 'cantidad_existencia', 'reactivo_id', 'laboratorio_id', 'unidad_id'];

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'laboratorio_id');
    }

    public function reactivo()
    {
        return $this->belongsTo(Reactivo::class, 'reactivo_id');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }
    
}
