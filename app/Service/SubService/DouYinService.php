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
use Fan\DouYin\OpenApi\Application;
use Han\Utils\Service;
use Hyperf\Codec\Json;
use Hyperf\Config\Annotation\Value;
use Psr\Container\ContainerInterface;

class DouYinService extends Service
{
    #[Value(key: 'douyin')]
    protected array $configs = [];

    /**
     * @var array<string, Application>
     */
    protected array $applications = [];

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        foreach ($this->configs as $config) {
            $this->applications[$config['app_id']] = new Application($config);
        }
    }

    public function get(string $appid): Application
    {
        if (empty($this->applications[$appid])) {
            throw new BusinessException(ErrorCode::APPID_NOT_EXIST);
        }

        return $this->applications[$appid];
    }

    public function login(string $code, string $appid): array
    {
        $dy = $this->get($appid);
        $client = $dy->http->client(options: [
            'base_uri' => 'https://developer.toutiao.com',
            'timeout' => 5,
        ]);
        $res = $client->post('/api/apps/v2/jscode2session', [
            'json' => [
                'appid' => $dy->config->getAppId(),
                'secret' => $dy->config->getAppSecret(),
                'code' => $code,
                'anonymous_code' => '',
            ],
        ]);

        return Json::decode((string) $res->getBody())['data'] ?? [];
    }
}
