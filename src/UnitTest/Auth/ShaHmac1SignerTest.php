<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
include_once '../../Config.php';
class ShaHmac1SignerTest extends PHPUnit_Framework_TestCase
{
    public function testShaHmac1Signer()
    {
        $signer = new ShaHmac1Signer();
        $this->assertEquals('33nmIV5/p6kG/64eLXNljJ5vw84=', $signer->signString('this is a ShaHmac1 test.', 'accessSecret'));
    }
}
