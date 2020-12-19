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
namespace SwoftTest\Cases;

use SwoftTest\Testing\Ecs\Request\DescribeRegionsRequest;
use SwoftTest\Testing\Sts\AssumeRoleRequest;

/**
 * @internal
 * @coversNothing
 */
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

    public function testStsAssumeRoleRequest()
    {
        $request = new AssumeRoleRequest();
        $request->setRoleSessionName('username');
        $request->setRoleArn('acs:ram::11111111:role/aliyunosstokengeneratorrole');
        $request->setPolicy('{
  "Statement": [
    {
      "Action": [
        "oss:GetObject",
        "oss:PutObject",
        "oss:DeleteObject",
        "oss:ListParts",
        "oss:AbortMultipartUpload",
        "oss:ListObjects"
      ],
      "Effect": "Allow",
      "Resource": ["acs:oss:*:*:$BUCKET_NAME/*", "acs:oss:*:*:$BUCKET_NAME"]
    }
  ],
  "Version": "1"
}');
        $request->setDurationSeconds(3600);
        try {
            $response = $this->client->getAcsResponse($request);
        } catch (\Throwable $ex) {
            $this->assertEquals(0, $ex->getCode());
        }
    }
}
