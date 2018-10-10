<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Cases\Http;

use SwoftTest\Cases\AbstractTestCase;
use Xin\Aliyun\Core\Http\HttpHelper;

class HttpHelperTest extends AbstractTestCase
{
    public function testCurl()
    {
        $httpResponse = HttpHelper::curl('ecs.aliyuncs.com');
        $this->assertEquals(400, $httpResponse->getStatus());
        $this->assertNotNull($httpResponse->getBody());
    }
}
