<?php

namespace App\Models;

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
}
