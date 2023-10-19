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
            'websiteId' => 'required|int',
            'userId' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function command()
    {
        return new CreatePostCommand(
            $this->websiteId,
            $this->userId,
            $this->title,
            $this->description

        );
    }
}
