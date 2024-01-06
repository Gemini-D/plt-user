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

namespace HyperfTest;

use App\Service\SubService\WeChatService;
use Hyperf\Testing;
use Mockery;
use PHPUnit\Framework\TestCase;

use function Hyperf\Support\make;

/**
 * Class HttpTestCase.
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 */
abstract class HttpTestCase extends TestCase
{
    public static bool $init = false;

    /**
     * @var Testing\Client
     */
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Testing\Client::class);
        // $this->client = make(Testing\HttpClient::class, ['baseUri' => 'http://127.0.0.1:9501']);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }

    protected function setUp(): void
    {
        if (! self::$init) {
            self::$init = true;
            di()->set(WeChatService::class, $wx = Mockery::mock(WeChatService::class . '[login]', [di()]));
            $wx->shouldReceive('login')->withAnyArgs()->andReturn(['openid' => 'ohjUY0TB_onjcaH2ia06HgGOC4CY']);
        }
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
