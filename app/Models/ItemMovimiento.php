<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMovimiento extends Model
{
    use HasFactory;

    protected $table = 'item_movimiento';

    protected $fillable = ['cantidad', 'reactivo_id', 'movimiento_id'];

    public function reactivo()
    {
        return $this->belongsTo(Reactivo::class, 'reactivo_id');
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class, 'movimiento_id');
    }
}
