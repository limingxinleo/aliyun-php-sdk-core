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
namespace SwoftTest\Cases;

use PHPUnit\Framework\TestCase;
use Xin\Aliyun\Core\DefaultAcsClient;
use Xin\Aliyun\Core\Profile\DefaultProfile;

/**
 * Class AbstractTestCase.
 */
abstract class AbstractTestCase extends TestCase
{
    /** @var DefaultAcsClient */
    public $client;

    protected function setUp()
    {
        parent::setUp();
        $iClientProfile = DefaultProfile::getProfile(
            'cn-shanghai',
            'LTAICF4YQ71yNSxK',
            'KR8oj49PJl3dT20vLCcxrDrCp1t769'
        );

        $this->client = new DefaultAcsClient($iClientProfile);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
