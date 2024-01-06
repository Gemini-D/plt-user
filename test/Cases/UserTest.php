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

namespace HyperfTest\Cases;

use App\RPC\UserService;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class UserTest extends HttpTestCase
{
    public function testFirstByCode()
    {
        $res = di()->get(UserService::class)->firstByCode('wx5effdaefdbb2671f', 'abc', 0);

        $this->assertTrue(is_int($res['id']));
    }
}
