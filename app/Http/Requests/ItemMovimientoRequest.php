<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemMovimientoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cantidad' => 'required|integer|min:1',  // Asegurar que sea un número entero y positivo
            'reactivo_id' => 'required|exists:reactivos,id',  // Validar que exista en la tabla 'reactivos'
            'movimiento_id' => 'required|exists:movimientos,id',  // Validar que exista en la tabla 'movimientos'
            'laboratorio_id' => 'required|exists:laboratorio,id',  // Verificar que el laboratorio exista
            'unidad_id' => 'required|exists:unidad,id',  // Verificar que la unidad exista
        ];
    }
}
