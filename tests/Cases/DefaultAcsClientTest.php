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

use SwoftTest\Testing\Ecs\Request\DescribeRegionsRequest;

class DefaultAcsClientTest extends AbstractTestCase
{
    public function testDoActionRPC()
    {
        $request = new DescribeRegionsRequest();
        $response = $this->client->getAcsResponse($request);
        
        $this->assertNotNull($response->RequestId);
        $this->assertNotNull($response->Regions->Region[0]->LocalName);
        $this->assertNotNull($response->Regions->Region[0]->RegionId);
    }
}
