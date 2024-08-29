<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
    use HasFactory;

    protected $table = 'reactivos';

    protected $fillable = [
        'nombre', 'img_reactivo', 'numero_cas', 'referencia_fabricante', 'lote',
        'num_registro_invima', 'familia_id', 'marca_id'
    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class, 'familia_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function itemsMovimiento()
    {
        return $this->hasMany(ItemMovimiento::class, 'reactivo_id');
    }

    public function stockReactivos()
    {
        return $this->hasMany(StockReactivo::class, 'reactivo_id');
    }
}
