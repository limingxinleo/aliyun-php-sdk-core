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
namespace SwoftTest\Cases\Auth;

use SwoftTest\Cases\AbstractTestCase;
use Xin\Aliyun\Core\Auth\Credential;

/**
 * @internal
 * @coversNothing
 */
class CredentialTest extends AbstractTestCase
{
    public function testCredential()
    {
        $credential = new Credential('accessKeyId', 'accessSecret', '');
        $this->assertEquals('accessKeyId', $credential->getAccessKeyId());
        $this->assertEquals('accessSecret', $credential->getAccessSecret());
        $this->assertNotNull($credential->getRefreshDate());

        $dateNow = date('Y-m-d\\TH:i:s\\Z');
        $credential->setExpiredDate(1);
        $this->assertNotNull($credential->getExpiredDate());
        $this->assertTrue($credential->getExpiredDate() > $dateNow);
    }
}
