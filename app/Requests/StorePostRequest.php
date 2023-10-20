<?php

namespace App\Requests;

use App\Commands\CreatePostCommand;
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
            'user_id' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function command()
    {
        return new CreatePostCommand(
            $this->website_id,
            $this->user_id,
            $this->title,
            $this->description

        );
    }
}
