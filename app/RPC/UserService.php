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

namespace App\RPC;

use GeminiD\PltCommon\RPC\User\UserInterface;
use Hyperf\RpcMultiplex\Constant;
use Hyperf\RpcServer\Annotation\RpcService;

#[RpcService(name: UserInterface::NAME, server: 'rpc', protocol: Constant::PROTOCOL_DEFAULT)]
class UserService implements UserInterface
{
    public function ping(): bool
    {
        return true;
    }
}
