<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // localhost:5173 is Vite’s default dev server port for React, zato smo ga tu dodali
    'allowed_origins' => ['http://localhost:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Allow the frontend (on a different origin like localhost:5173) to send cookies, Authorization headers, or credentials (like tokens) to the backend. When it's true, you cannot use wildcard (*) for allowed_origins - znači treba bit "true" da bi komunicirali s frontend-om
    'supports_credentials' => true

];
