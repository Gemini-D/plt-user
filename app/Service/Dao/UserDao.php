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

namespace App\Service\Dao;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Model\User;
use App\Model\UserOauth;
use GeminiD\PltCommon\Constant\OAuthType;
use Han\Utils\Service;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Snowflake\IdGeneratorInterface;

class UserDao extends Service
{
    #[Inject]
    protected IdGeneratorInterface $generator;

    public function first(int $id, bool $throw = false): ?User
    {
        $model = User::findFromCache($id);
        if (! $model && $throw) {
            throw new BusinessException(ErrorCode::USER_NOT_EXIST);
        }

        return $model;
    }

    public function firstOrCreate(string $openid, string $appid, OAuthType $type): User
    {
        $model = UserOauth::query()->where('openid', $openid)
            ->where('appid', $appid)
            ->where('type', $type)
            ->first();

        if (! $model) {
            $model = new UserOauth();
            $model->openid = $openid;
            $model->appid = $appid;
            $model->type = $type;
            $model->user_id = $this->generator->generate();
            $model->save();
        }

        $user = $this->first($model->user_id);
        if (! $user) {
            $user = new User();
            $user->id = $model->user_id;
            $user->save();
        }

        return $user;
    }
}
