<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Cases\Auth;

use SwoftTest\Cases\AbstractTestCase;
use Xin\Aliyun\Core\Auth\ShaHmac256Signer;

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
