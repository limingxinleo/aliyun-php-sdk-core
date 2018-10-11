<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Cases\Regions;

use SwoftTest\Cases\AbstractTestCase;
use Xin\Aliyun\Core\Regions\EndpointProvider;

class EndpointProviderTest extends AbstractTestCase
{
    public function testFindProductDomain()
    {
        $this->assertEquals('ecs-cn-hangzhou.aliyuncs.com', EndpointProvider::findProductDomain('cn-hangzhou', 'Ecs'));
    }
}
