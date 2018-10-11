<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Cases;

use PHPUnit\Framework\TestCase;
use Xin\Aliyun\Core\DefaultAcsClient;
use Xin\Aliyun\Core\Profile\DefaultProfile;

/**
 * Class AbstractTestCase
 *
 * @package SwoftTest\Db\Cases
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
