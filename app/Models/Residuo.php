<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residuo extends Model
{
    use HasFactory;

    protected $table = 'residuos';

    protected $fillable = [
        'nombre', 'clase_residuo_id'
    ];

    public function clase_residuo()
    {
        return $this->belongsTo(ClaseResiduo::class, 'clase_residuo_id');
    }

    public function stockResiduos()
    {
        return $this->hasMany(ResiduoLaboratorio::class, 'residuo_id');
    }
}
