<?php

namespace Xin\Aliyun\Core;

class Constant
{
    const STS_PRODUCT_NAME = 'Sts';

    const STS_VERSION = '2015-04-01';

    const STS_ACTION = 'AssumeRole';

    const STS_REGION = 'cn-hangzhou';

    const ROLE_ARN_EXPIRE_TIME = 3600;

    const ECS_ROLE_EXPIRE_TIME = 3600;

    const AUTH_TYPE_RAM_AK = 'RAM_AK';

    const AUTH_TYPE_RAM_ROLE_ARN = 'RAM_ROLE_ARN';

    const AUTH_TYPE_ECS_RAM_ROLE = 'ECS_RAM_ROLE';

    const LOCATION_SERVICE_PRODUCT_NAME = 'Location';

    const LOCATION_SERVICE_DOMAIN = 'location.aliyuncs.com';

    const LOCATION_SERVICE_VERSION = '2015-06-12';

    const LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION = 'DescribeEndpoints';

    const LOCATION_SERVICE_REGION = 'cn-hangzhou';

    const CACHE_EXPIRE_TIME = 3600;

    const ENABLE_HTTP_PROXY = false;

    const HTTP_PROXY_IP = '127.0.0.1';

    const HTTP_PROXY_PORT = '8888';
}