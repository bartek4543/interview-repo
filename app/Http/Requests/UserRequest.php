<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /** @return bool */
    public function authorize(): bool
    {
        return true;
    }

    /** @return array */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|' . Rule::unique('users')->ignore($this->id, 'id'),
            'password' => 'confirmed|min:6|required' . Rule::excludeIf((bool) $this->id),
        ];
    }
}
