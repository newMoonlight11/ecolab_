<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
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
            'reactivo_id' => 'required|exists:reactivos,id',
            'unidad_id' => 'required|exists:unidad,id',
            'laboratorio_id' => 'required|exists:laboratorio,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'email' => 'required|email',
        ];
    }
}
