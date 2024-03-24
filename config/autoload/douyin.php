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
        'app_id' => env('DY_APP_ID'),
        'app_secret' => env('DY_SECRET'),
        'payment' => [
            'salt' => '',
            'token' => '',
        ],
    ],
];
