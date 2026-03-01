<?php

namespace App\Http\Requests\Admin\Palabra;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePalabra extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.palabra.edit', $this->palabra);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string'],
            'slug' => ['nullable', Rule::unique('palabra', 'slug')->ignore($this->palabra->getKey(), $this->palabra->getKeyName()), 'string'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['sometimes', 'boolean'],
            'link' => ['nullable', 'string'],
            'categoria_id' => ['sometimes', 'string'],
            
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


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
