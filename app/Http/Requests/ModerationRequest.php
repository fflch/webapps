<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ModerationRequest extends FormRequest
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
            "database_name" => ["required"],
            "database_username" => ["required"],
            "database_password" => ["required"],
            "bucket_name" => ["required"],
            "bucket_username" => ["required"],
            "bucket_password" => ["required"],
        ];
    }

    public function messages(){
        return [
            "database_name.required" => "O nome da database é obrigatório",
            "database_username.required" => "O username da dabatase é obrigatório",
            "database_password.required" => "A senha da database é obrigatória",
            "bucket_name.required" => "O nome bucket é obrigatório",
            "bucket_username.required" => "O usuário do bucket é obrigatório",
            "bucket_password.required" => "A senha do bucket é obrigatória",
        ];
    }
}
