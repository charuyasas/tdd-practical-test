<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizedFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
