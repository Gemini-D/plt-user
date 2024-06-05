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

namespace App\Constants;

use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\Annotation\Message;
use Hyperf\Constants\EnumConstantsTrait;

#[Constants]
enum ErrorCode: int implements ErrorCodeInterface
{
    use EnumConstantsTrait;

    #[Message('Server Error')]
    case SERVER_ERROR = 500;

    #[Message('AppID 不存在')]
    case APPID_NOT_EXIST = 1001;

    #[Message('微信小程序 登录码已失效')]
    case MP_CODE_INVALID = 1002;

    #[Message('用户不存在')]
    case USER_NOT_EXIST = 1100;

    public function getMessage(?array $translate = null): string
    {
        $arguments = [];
        if ($translate) {
            $arguments = [$translate];
        }

        return $this->__call('getMessage', $arguments);
    }
}
