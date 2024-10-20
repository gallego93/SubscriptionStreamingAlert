<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LoadServiceSettings
{
    public function handle($request, Closure $next)
    {
        $services = ['twilio', 'mailgun', 'stripe'];

        foreach ($services as $service) {
            $serviceSettings = Cache::remember("{$service}_settings", 60 * 60, function () use ($service) {
                return Setting::where('category', $service)->pluck('value', 'key');
            });

            foreach ($serviceSettings as $key => $value) {
                config(["{$service}.{$key}" => $value]);
            }
        }

        return $next($request);
    }
}
