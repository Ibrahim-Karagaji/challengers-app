<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "userName" => "sometimes|string|max:20",
            "avatar" => "sometimes|image|max:512|mimes:jpg,jpeg,png,webp"
        ];
    }
}
