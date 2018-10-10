<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
include_once 'BaseTest.php';
use UnitTest\Ecs\Request as Ecs;
use UnitTest\BatchCompute\Request as BC;

class DefaultAcsClientTest extends BaseTest
{
    public function testDoActionRPC()
    {
        $request = new Ecs\DescribeRegionsRequest();
        $response = $this->client->doAction($request);
        
        $this->assertNotNull($response->RequestId);
        $this->assertNotNull($response->Regions->Region[0]->LocalName);
        $this->assertNotNull($response->Regions->Region[0]->RegionId);
    }
    
    public function testDoActionROA()
    {
        $request = new BC\ListImagesRequest();
        $response = $this->client->doAction($request);
        $this->assertNotNull($response);
    }
}
