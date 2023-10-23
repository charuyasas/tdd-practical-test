<?php

namespace App\Requests;

use App\Commands\CreatePostCommand;
use App\Traits\AuthorizeTrait;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    use AuthorizeTrait;

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function command(): CreatePostCommand
    {
        $command = new CreatePostCommand();
        $command->title = $this->title;
        $command->description = $this->description;

        return $command;
    }
}
