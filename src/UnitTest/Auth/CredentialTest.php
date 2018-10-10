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
class CredentialTest extends PHPUnit_Framework_TestCase
{
    public function testCredential()
    {
        $credential = new Credential('accessKeyId', 'accessSecret');
        $this->assertEquals('accessKeyId', $credential->getAccessKeyId());
        $this->assertEquals('accessSecret', $credential->getAccessSecret());
        $this->assertNotNull($credential->getRefreshDate());
        
        $dateNow = date("Y-m-d\TH:i:s\Z");
        $credential->setExpiredDate(1);
        $this->assertNotNull($credential->getExpiredDate());
        $this->assertTrue($credential->getExpiredDate() > $dateNow);
    }
}
