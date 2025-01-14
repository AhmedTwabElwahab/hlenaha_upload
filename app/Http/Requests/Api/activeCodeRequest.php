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

    protected function onUpdate(): array
    {
        $this->rules['password'] = 'required|string';
        return $this->rules;
    }
    protected function onCreate(): array
    {
        return $this->rules;
    }
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }
}
