<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends APIRequest
{
    protected array $rules = [
        'name'              => 'required|string',
        'phone'             => 'required|string',
        'gender'            => 'sometimes|nullable|string',
        'birth_date'        => 'sometimes|nullable|date',
        'email'             => 'required|email|unique:users',
        'password'          => 'required|min:4',
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->rules;
    }
}
