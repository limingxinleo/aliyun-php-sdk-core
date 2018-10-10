<?php

namespace Xin\Aliyun\Core\Regions;

use Xin\Aliyun\Core\Constant;

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