<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResiduoLaboratorio extends Model
{
    use HasFactory;

    protected $table = 'residuo_laboratorios';

    protected $fillable = ['fecha_stock', 'cantidad_existencia', 'residuo_id', 'laboratorio_id', 'unidad_id'];

    public function residuo()
    {
        return $this->belongsTo(Residuo::class, 'residuo_id');
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
