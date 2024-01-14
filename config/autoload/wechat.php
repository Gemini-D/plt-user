<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use function Hyperf\Support\env;

return [
    [
        'app_id' => env('MP_APP_ID'),
        'secret' => env('MP_SECRET'),
        'token' => '',
        'aes_key' => '',

        'use_stable_access_token' => true,

        'http' => [
            'throw' => true,
            'timeout' => 5.0,

            'retry' => true,
        ],
    ],
    [
        'app_id' => env('MP2_APP_ID'),
        'secret' => env('MP2_SECRET'),
        'token' => '',
        'aes_key' => '',

        'use_stable_access_token' => true,

        'http' => [
            'throw' => true,
            'timeout' => 5.0,

            'retry' => true,
        ],
    ],
];
