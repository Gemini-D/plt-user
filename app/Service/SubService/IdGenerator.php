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

use Han\Utils\Service;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Snowflake\IdGeneratorInterface;

class IdGenerator extends Service
{
    #[Inject]
    protected IdGeneratorInterface $generator;

    public function id(): int
    {
        return $this->generator->generate();
    }
}
