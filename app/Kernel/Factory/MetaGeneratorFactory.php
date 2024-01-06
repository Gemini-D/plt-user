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

namespace App\Kernel\Factory;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Snowflake\ConfigurationInterface;
use Hyperf\Snowflake\MetaGenerator\RedisSecondMetaGenerator;
use Hyperf\Snowflake\MetaGeneratorInterface;
use Psr\Container\ContainerInterface;

use function Hyperf\Tappable\tap;

class MetaGeneratorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class);
        $beginSecond = $config->get('snowflake.begin_second', MetaGeneratorInterface::DEFAULT_BEGIN_SECOND);

        // WARNING
        // @see https://hyperf.wiki/3.1/#/zh-cn/snowflake
        // 默认的雪花算法，有 5位 datacenterId 和 5位 workerId 又因为此项目使用单进程模式，故最多只能开 1024 个 pod
        // 因为使用的是秒级 ID，所以最大可支撑使用时间为 PHP_INT_MAX / 1024 / 4095 / 86400 / 365 = 69747 年
        return tap(
            new RedisSecondMetaGenerator(
                $container->get(ConfigurationInterface::class),
                $beginSecond,
                $config,
            ),
            fn (RedisSecondMetaGenerator $generator) => $generator->init()
        );
    }
}
