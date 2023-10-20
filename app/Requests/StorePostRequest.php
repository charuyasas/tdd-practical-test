<?php

namespace App\Requests;

use App\Commands\CreatePostCommand;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'website_id' => 'required|int',
            'user_id' => 'required|int',
            'title' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function command(): CreatePostCommand
    {
        $command = new CreatePostCommand();
        $command->website_id = $this->website_id;
        $command->user_id = $this->user_id;
        $command->title = $this->title;
        $command->description = $this->description;
        return $command;
    }
}
