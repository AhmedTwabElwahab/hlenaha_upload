<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class activeCodeRequest extends APIRequest
{
    protected array $rules = [
        'code'              => 'required|numeric|not_in:0',
        'email'             => 'required|email',
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
