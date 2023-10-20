<?php

namespace App\Requests;

use App\Commands\CreateSubscriptionCommand;
use App\Commands\SubscribeUserCommand;
use App\Models\Website;
use App\Traits\AuthorizeTrait;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeWebsiteRequest extends FormRequest
{
    use AuthorizeTrait;

    public function rules(): array
    {
        return [
            'website_id' => 'required|int'
        ];
    }

    public function command(): Website
    {
        return Website::where('id',$this->website_id)->first();
    }
}
