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
use Xin\Aliyun\Core\Auth\ShaHmac1Signer;

/**
 * @internal
 * @coversNothing
 */
class ShaHmac1SignerTest extends AbstractTestCase
{
    public function testShaHmac1Signer()
    {
        $signer = new ShaHmac1Signer();
        $this->assertEquals('33nmIV5/p6kG/64eLXNljJ5vw84=', $signer->signString('this is a ShaHmac1 test.', 'accessSecret'));
    }
}
