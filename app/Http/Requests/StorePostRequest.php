<?php

namespace App\Http\Requests;

use App\DTOs\PostDTO;
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

    public function getPostDTO()
    {
        return new PostDTO(
            $this->website_id,
            $this->title,
            $this->description
        );

    }
}
