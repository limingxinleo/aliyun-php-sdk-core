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
use Xin\Aliyun\Core\Profile\DefaultProfile;
use Xin\Aliyun\Core\Regions\LocationService;

/**
 * @internal
 * @coversNothing
 */
class EndPointByLocationTest extends AbstractTestCase
{
    /** @var LocationService */
    private $locationService;

    private $clientProfile;

    public function testFindProductDomain()
    {
        $this->initClient();
        $domain = $this->locationService->findProductDomain('cn-shanghai', 'apigateway', 'openAPI', 'CloudAPI');
        $this->assertEquals('apigateway.cn-shanghai.aliyuncs.com', $domain);
    }

    public function testFindProductDomainWithAddEndPoint()
    {
        DefaultProfile::addEndpoint('cn-shanghai', 'cn-shanghai', 'CloudAPI', 'apigateway.cn-shanghai123.aliyuncs.com');
        $this->initClient();
        $domain = $this->locationService->findProductDomain('cn-shanghai', 'apigateway', 'openAPI', 'CloudAPI');
        $this->assertEquals('apigateway.cn-shanghai123.aliyuncs.com', $domain);
    }

    private function initClient()
    {
        # 创建 DefaultAcsClient 实例并初始化
        $this->clientProfile = DefaultProfile::getProfile(
            'cn-shanghai',                   # 您的 Region ID
            'LTAICF4YQ71yNSxK',               # 您的 Access Key ID
            'KR8oj49PJl3dT20vLCcxrDrCp1t769'            # 您的 Access Key Secret
        );

        $this->locationService = new LocationService($this->clientProfile);
    }
}
