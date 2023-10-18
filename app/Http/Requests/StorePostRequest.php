<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'website_id' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
