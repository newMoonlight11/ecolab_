<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reactivo
 *
 * @property $id
 * @property $nombre
 * @property $fecha_vencimiento
 * @property $cantidad
 * @property $laboratorio
 * @property $familia
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reactivo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'fecha_vencimiento', 'cantidad', 'laboratorio', 'familia'];


}
