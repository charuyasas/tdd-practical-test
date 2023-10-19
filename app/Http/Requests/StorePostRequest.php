<?php

namespace App\Http\Requests;

use App\Commands\PostCommand;
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

    public function commandData()
    {
        return new PostCommand(
            $this->websiteId,
            $this->title,
            $this->description

        );
    }
}
