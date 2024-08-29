<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marca';

    protected $fillable = ['nombre'];

    public function reactivos()
    {
        return $this->hasMany(Reactivo::class, 'marca_id');
    }
}
