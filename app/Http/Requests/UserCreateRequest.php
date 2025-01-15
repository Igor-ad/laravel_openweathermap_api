<?php

namespace App\Http\Requests;

use App\Enums\ProviderEnum as Provider;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return match ($this->route()->parameter('provider')) {
            Provider::USERS->value =>
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed', 'min:8'],
            ],
            default => [],
        };
    }
}
