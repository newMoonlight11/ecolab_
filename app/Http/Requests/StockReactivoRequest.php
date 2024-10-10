<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockReactivoRequest extends FormRequest
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
            'fecha_stock' => 'required|date',  // Validar que sea una fecha válida
            'cantidad_existencia' => 'required|integer|min:1',  // Asegurar que sea un entero positivo
            'reactivo_id' => 'required|exists:reactivos,id',  // Verificar que el reactivo exista
            'laboratorio_id' => 'required|exists:laboratorio,id',  // Verificar que el laboratorio exista
            'unidad_id' => 'required|exists:unidad,id',  // Verificar que la unidad exista
        ];
    }
}
