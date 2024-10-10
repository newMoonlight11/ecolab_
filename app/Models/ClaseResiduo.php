<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaseResiduo extends Model
{
    use HasFactory;

    protected $table = 'clase_residuos';

    protected $fillable = ['nombre'];

    public function residuos()
    {
        return $this->hasMany(Residuo::class, 'clase_residuo_id');
    }
}
