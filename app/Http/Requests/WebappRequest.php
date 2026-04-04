<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WebappRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dominio' => 'required',
            //'url_github' => ['nullable','url'],
            'url_github' => ['nullable'],
            'justificativa' => 'required',
            'tipo' => 'required',
            'database_username' => 'nullable',
            'database_name' => 'nullable',
            'database_password' => 'nullable',
            'bucket_username' => 'nullable',
            'bucket_password' => 'nullable',
            'bucket_name' => 'nullable',
            'version ' => 'nullable',
        ];
    }

    public function messages(){
        return [
            'dominio.required' => 'O domínio é obrigatório',
            'justificativa.required' => 'A justificativa é obrigatória',
            'tipo.required' => 'O tipo é obrigatório',
            //'url_github.url' => 'url'
        ];
    }

}
