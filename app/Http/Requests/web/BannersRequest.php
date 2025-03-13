<?php

namespace App\Http\Requests\web;

use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class BannersRequest extends FormRequest
{
    protected array $rules = [
        'image'            => 'required|image',
        'title'            => 'required|string',
        'disc'            => 'required|string',
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
        $this->rules['image'] = 'sometimes|nullable|image';
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
