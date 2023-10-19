<?php

namespace App\Http\Requests;


use App\Commands\SubscribeUserCommand;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeWebsiteRequest extends FormRequest
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
        ];
    }

    public function commandData()
    {
        return new SubscribeUserCommand(
            $this->websiteId,
            $this->userId,
        );
    }
}
