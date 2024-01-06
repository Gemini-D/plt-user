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

namespace App\Service\SubService;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use EasyWeChat\MiniApp\Application;
use Han\Utils\Service;
use Hyperf\Codec\Json;
use Hyperf\Config\Annotation\Value;
use JetBrains\PhpStorm\ArrayShape;
use Psr\Container\ContainerInterface;

class WeChatService extends Service
{
    #[Value(key: 'wechat')]
    protected array $configs;

    /**
     * @var array<string, Application>
     */
    protected array $applications;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        foreach ($this->configs as $config) {
            $this->applications[$config['app_id']] = new Application($config);
        }
    }

    public function get(string $appid): Application
    {
        if (! $this->applications[$appid]) {
            throw new BusinessException(ErrorCode::WECHAT_APPID_NOT_EXIST);
        }

        return $this->applications[$appid];
    }

    #[ArrayShape(['openid' => 'string'])]
    public function login(string $code, string $appid)
    {
        $application = $this->get($appid);
        $result = $application->getClient()->get('/sns/jscode2session', [
            'query' => [
                'appid' => $application->getAccount()->getAppId(),
                'secret' => $application->getAccount()->getSecret(),
                'js_code' => $code,
                'grant_type' => 'authorization_code',
            ],
        ]);

        return Json::decode($result->getContent());
    }
}
