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
            'websiteId' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function getPostDTO()
    {
        return new PostDTO(
            $this->websiteId,
            $this->title,
            $this->description
        );

    }
}
