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

    public function claseResiduo()
    {
        return $this->belongsTo(ClaseResiduo::class, 'clase_residuo_id');
    }

    public function ResiduoLaboratorios()
    {
        return $this->hasMany(ResiduoLaboratorio::class, 'residuo_id');
    }
}
