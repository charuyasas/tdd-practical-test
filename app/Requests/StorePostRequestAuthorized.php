<?php

namespace App\Requests;

use App\Commands\CreatePostCommand;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequestAuthorized extends AuthorizedFormRequest
{
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
        $command->website = $this->website;
        $command->title = $this->title;
        $command->description = $this->description;

        return $command;
    }
}
