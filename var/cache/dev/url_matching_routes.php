<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    true, // $matchHost
    [ // $staticRoutes
        '/' => [[['_route' => 'index', '_controller' => 'App\\Controller\\IndexController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
            .'|(?:(?:[^./]*+\\.)++)(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:57)'
            .')|(?i:localhost)\\.(?'
                .'|/test(?:/([A-z0-9]{0,}))?(*:109)'
            .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        57 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        109 => [
            [['_route' => 'test', 'name' => 'world', '_controller' => 'App\\Controller\\HelloController::test'], ['name'], ['GET' => 0, 'POST' => 1], ['https' => 0, 'http' => 1], false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
