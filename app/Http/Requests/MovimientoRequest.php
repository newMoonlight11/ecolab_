<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoRequest extends FormRequest
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
            'fecha_movimiento' => 'required|date',  // Validar como fecha
            'descripcion' => 'required|string',     // El campo 'text' no tiene límite de longitud
            'tipo_movimiento' => 'required|integer|exists:tipo_movimiento,id',  // Verificar si el campo es singular
            'usuario_id' => 'required|integer|exists:users,id',                 // Validación de existencia
            'estado' => 'nullable|string',
        ];
        
    }
}
