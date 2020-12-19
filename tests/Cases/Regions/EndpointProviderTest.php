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
namespace SwoftTest\Cases\Regions;

use SwoftTest\Cases\AbstractTestCase;
use Xin\Aliyun\Core\Regions\EndpointProvider;

/**
 * @internal
 * @coversNothing
 */
class EndpointProviderTest extends AbstractTestCase
{
    public function testFindProductDomain()
    {
        $this->assertEquals('ecs-cn-hangzhou.aliyuncs.com', EndpointProvider::findProductDomain('cn-hangzhou', 'Ecs'));
    }
}
