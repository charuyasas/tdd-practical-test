<?php

namespace App\Http\Requests;

use App\DTOs\SubscribeDTO;
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

    public function getSubscribeDTO()
    {
        return new SubscribeDTO(
            $this->websiteId,
            $this->userId,
        );
    }
}
