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

namespace App\Model;

use Carbon\Carbon;
use GeminiD\PltCommon\Constant\OAuthType;

/**
 * @property int $id
 * @property int $user_id
 * @property OAuthType $type
 * @property string $appid
 * @property string $openid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserOauth extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user_oauth';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'user_id', 'type', 'appid', 'openid', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'user_id' => 'integer', 'type' => OAuthType::class, 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
