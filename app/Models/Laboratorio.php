<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $table = 'laboratorio';

    protected $fillable = ['nombre'];

    public function stockReactivos()
    {
        return $this->hasMany(StockReactivo::class, 'laboratorio_id');
    }

    public function stockResiduos()
    {
        return $this->hasMany(ResiduoLaboratorio::class, 'laboratorio_id');
    }
}
