<?php

if (! function_exists('site_title')) {
    /**
     * Convert config info into the site title.
     *
     * @return string
     */
    function site_title()
    {
        return config('app.name');
    }
}

if (! function_exists('site_color')) {
    /**
     * Convert config info into the site color.
     *
     * @return string
     */
    function site_color()
    {
        return config('mail.style.color');
    }
}

if (! function_exists('gplus')) {
    /**
     * Convert config info into the site google plus address.
     *
     * @return string
     */
    function gplus()
    {
        // return config('sites.' . config('app.site') . '.gplus');
    }
}

if (! function_exists('twitter')) {
    /**
     * Convert config info into the site twitter address.
     *
     * @return string
     */
    function twitter()
    {
        // return config('sites.' . config('app.site') . '.twitter');
    }
}

if (! function_exists('facebook')) {
    /**
     * Convert config info into the site facebook address.
     *
     * @return string
     */
    function facebook()
    {
        // return config('sites.' . config('app.site') . '.facebook');
    }
}

if (! function_exists('linkedin')) {
    /**
     * Convert config info into the site linkedin address.
     *
     * @return string
     */
    function linkedin()
    {
        // return config('sites.' . config('app.site') . '.linkedin');
    }
}