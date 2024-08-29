<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockReactivo extends Model
{
    use HasFactory;

    protected $table = 'stock_reactivos';

    protected $fillable = ['fecha_stock', 'cantidad_existencia', 'reactivo_id', 'laboratorio_id', 'unidad_id'];

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
