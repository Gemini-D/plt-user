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
use App\Kernel\Event\EventDispatcherFactory;
use App\Kernel\Factory\MetaGeneratorFactory;
use App\Kernel\Http\WorkerStartListener;
use App\Kernel\Log\LoggerFactory;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Server\Listener\AfterWorkerStartListener;
use Hyperf\Snowflake\MetaGeneratorInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * This file is part of Hyperf.
 *
 * @see     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    StdoutLoggerInterface::class => LoggerFactory::class,
    AfterWorkerStartListener::class => WorkerStartListener::class,
    EventDispatcherInterface::class => EventDispatcherFactory::class,
    MetaGeneratorInterface::class => MetaGeneratorFactory::class,
];
