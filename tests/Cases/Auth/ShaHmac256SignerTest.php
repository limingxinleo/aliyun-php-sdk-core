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
use Xin\Aliyun\Core\Auth\ShaHmac256Signer;

/**
 * @internal
 * @coversNothing
 */
class ShaHmac256SignerTest extends AbstractTestCase
{
    public function testShaHmac256Signer()
    {
        $signer = new ShaHmac256Signer();
        $this->assertEquals(
            'TpF1lE/avV9EHGWGg9Vo/QTd2bLRwFCk9jjo56uRbCo=',
            $signer->signString('this is a ShaHmac256 test.', 'accessSecret')
        );
    }
}
