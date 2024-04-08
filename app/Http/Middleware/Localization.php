<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        } else {
            if (env('DB_DATABASE') != null) {
                $setting = Setting::first();
                if ($setting !== null) {
                    $language = $setting->language;
                    $direction = Language::where('name', $language)->first()->direction;
                    App::setLocale($language);
                    session()->put('locale', $language);
                    session()->put('direction', $direction);
                } else {
                    // Handle the case when $setting is null
                    // For example, provide a default language and direction
                    $language = 'en'; // Default language
                    $direction = 'ltr'; // Default direction
                    App::setLocale($language);
                    session()->put('locale', $language);
                    session()->put('direction', $direction);
                    // Log an error message or take other appropriate action
                    error_log("Error: No settings found in the database");
                }
            }
        }
        return $next($request);
    }
}
