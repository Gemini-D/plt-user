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

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Service\Dao\UserDao;
use App\Service\SubService\WeChatService;
use GeminiD\PltCommon\Constant\OAuthType;
use GeminiD\PltCommon\RPC\User\UserInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcMultiplex\Constant;
use Hyperf\RpcServer\Annotation\RpcService;
use Idempotent\Idempotent;
use JetBrains\PhpStorm\ArrayShape;

#[RpcService(name: UserInterface::NAME, server: 'rpc', protocol: Constant::PROTOCOL_DEFAULT)]
class UserService implements UserInterface
{
    #[Inject]
    protected Idempotent $idempotent;

    public function ping(): bool
    {
        return true;
    }

    #[ArrayShape(['id' => 'int', 'openid' => 'string'])]
    public function firstByCode(string $code, string $appid, int|OAuthType $type = OAuthType::WECHAT_MINI_APP): array
    {
        if (is_int($type)) {
            $type = OAuthType::from($type);
        }

        $res = di()->get(WeChatService::class)->login($code, $appid);
        if (empty($res['openid'])) {
            throw new BusinessException(ErrorCode::WECHAT_CODE_INVALID);
        }

        $user = $this->idempotent->run('first-user-by-openid:' . $res['openid'], fn () => di()->get(UserDao::class)->firstOrCreate($res['openid'], $appid, $type));

        return [
            'id' => $user->id,
            'openid' => $res['openid'],
        ];
    }
}
