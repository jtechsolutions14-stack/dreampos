<?php

use App\Models\CompanySetting;

if (! function_exists('company_settings')) {
    /**
     * Get the CompanySetting model instance, or a specific value.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function company_settings(string $key = null, $default = null)
    {
        static $settings;

        if (is_null($settings)) {
            $settings = CompanySetting::first();
        }

        if (! $settings) {
            if (is_null($key)) {
                return null;
            }

            return value($default);
        }

        if (is_null($key)) {
            return $settings;
        }

        return data_get($settings, $key, $default);
    }
}

if (! function_exists('company_setting')) {
    /**
     * Shortcut to get a single company setting value.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function company_setting(string $key = null, $default = null)
    {
        return company_settings($key, $default);
    }
}

if (! function_exists('company_logo_url')) {
    /**
     * URL for the company logo with fallback.
     *
     * @param  string|null  $fallback
     * @return string
     */
    function company_logo_url(string $fallback = null)
    {
        $logo = company_settings('logo');

        if ($logo) {
            return asset('storage/' . $logo);
        }

        return $fallback ?? asset('assets/img/logo.png');
    }
}

if (! function_exists('company_favicon_url')) {
    function company_favicon_url(string $fallback = null)
    {
        $favicon = company_settings('favicon');

        if ($favicon) {
            return asset('storage/' . $favicon);
        }

        return $fallback ?? asset('assets/img/favicon.png');
    }
}
