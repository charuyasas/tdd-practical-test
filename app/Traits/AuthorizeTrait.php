<?php

namespace App\Traits;

trait AuthorizeTrait {
    public function authorize(): bool
    {
        return true;
    }
}
