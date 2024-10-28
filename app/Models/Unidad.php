<?php

namespace App\Models;

use App\Http\Controllers\PrestamoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidad';

    protected $fillable = ['nombre'];

    public function stockReactivos()
    {
        return $this->hasMany(StockReactivo::class, 'unidad_id');
    }

    public function stockResiduos()
    {
        return $this->hasMany(ResiduoLaboratorio::class, 'unidad_id');
    }

    public function prestamos()
    {
        return $this->hasMany(PrestamoController::class, 'unidad_id');
    }
}
