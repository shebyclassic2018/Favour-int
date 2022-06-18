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

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];

// <?php

// use Asm89\Stack\Cors;

// $app = new Cors($app, [
//     // you can use ['*'] to allow any headers
//     'allowedHeaders'      => ['x-allowed-header', 'x-other-allowed-header'],
//     // you can use ['*'] to allow any methods
//     'allowedMethods'      => ['DELETE', 'GET', 'POST', 'PUT'],
//     // you can use ['*'] to allow requests from any origin
//     'allowedOrigins'      => ['localhost'],
//     // you can enter regexes that are matched to the origin request header
//     'allowedOriginsPatterns' => ['/localhost:\d/'],
//     'exposedHeaders'      => false,
//     'maxAge'              => false,
//     'supportsCredentials' => false,
// ]);
