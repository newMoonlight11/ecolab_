<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResiduoLaboratorioRequest extends FormRequest
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
            'fecha_stock' => 'required|date',
            'cantidad_existencia' => 'required|integer|min:1',
            'residuo_id' => 'required|exists:residuos,id',
            'laboratorio_id' => 'required|exists:laboratorio,id',
            'unidad_id' => 'required|exists:unidad,id',
        ];
    }
}
