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
use Xin\Aliyun\Core\Profile\DefaultProfile;
use Xin\Aliyun\Core\Regions\LocationService;

class EndPointByLocationTest extends AbstractTestCase
{
    /** @var  LocationService */
    private $locationService;

    private $clientProfile;

    private function initClient()
    {
        # 创建 DefaultAcsClient 实例并初始化
        $this->clientProfile = DefaultProfile::getProfile(
            'cn-shanghai',                   # 您的 Region ID
            '<your AK>',               # 您的 Access Key ID
            '<your Secret>'            # 您的 Access Key Secret
        );

        $this->locationService = new LocationService($this->clientProfile);
    }

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
}
