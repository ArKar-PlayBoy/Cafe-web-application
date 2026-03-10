<?php

namespace App\Listeners;

use App\Events\UserPermissionsChanged;
use Illuminate\Support\Facades\Cache;

class ClearUserPermissionsCache
{
    public function handle(UserPermissionsChanged $event): void
    {
        $user = $event->user;
        Cache::forget("user:{$user->id}:permissions");
    }
}
