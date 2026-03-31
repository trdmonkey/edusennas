<?php

namespace App\Http\Requests\Admin\Palabra;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePalabra extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.palabra.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string'],
            'slug' => [
                'nullable',
                'string',
                Rule::unique('palabra', 'slug')->ignore($this->palabra),
            ],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required'],
            'link' => ['nullable', 'string'],
            'categoria_id' => ['required', 'string'],
            'media.*' => ['nullable'],
            
        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        // convertir "true" o "false" a 1 ó 0
        $sanitized['estado'] = $this->has('estado') && $this->estado ? 1 : 0;

        return $sanitized;
    }

}
