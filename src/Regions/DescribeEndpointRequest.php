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
namespace Xin\Aliyun\Core\Regions;

use Xin\Aliyun\Core\Constant;
use Xin\Aliyun\Core\RpcAcsRequest;

class DescribeEndpointRequest extends RpcAcsRequest
{
    public function __construct($id, $serviceCode, $endPointType)
    {
        parent::__construct(
            Constant::LOCATION_SERVICE_PRODUCT_NAME,
            Constant::LOCATION_SERVICE_VERSION,
            Constant::LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION
        );

        $this->queryParameters['Id'] = $id;
        $this->queryParameters['ServiceCode'] = $serviceCode;
        $this->queryParameters['Type'] = $endPointType;
        $this->setRegionId(Constant::LOCATION_SERVICE_REGION);

        $this->setAcceptFormat('JSON');
    }
}
