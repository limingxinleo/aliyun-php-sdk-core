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
namespace Xin\Aliyun\Core;

class Constant
{
    public const STS_PRODUCT_NAME = 'Sts';

    public const STS_VERSION = '2015-04-01';

    public const STS_ACTION = 'AssumeRole';

    public const STS_REGION = 'cn-hangzhou';

    public const ROLE_ARN_EXPIRE_TIME = 3600;

    public const ECS_ROLE_EXPIRE_TIME = 3600;

    public const AUTH_TYPE_RAM_AK = 'RAM_AK';

    public const AUTH_TYPE_RAM_ROLE_ARN = 'RAM_ROLE_ARN';

    public const AUTH_TYPE_ECS_RAM_ROLE = 'ECS_RAM_ROLE';

    public const LOCATION_SERVICE_PRODUCT_NAME = 'Location';

    public const LOCATION_SERVICE_DOMAIN = 'location.aliyuncs.com';

    public const LOCATION_SERVICE_VERSION = '2015-06-12';

    public const LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION = 'DescribeEndpoints';

    public const LOCATION_SERVICE_REGION = 'cn-hangzhou';

    public const CACHE_EXPIRE_TIME = 3600;

    public const ENABLE_HTTP_PROXY = false;

    public const HTTP_PROXY_IP = '127.0.0.1';

    public const HTTP_PROXY_PORT = '8888';
}
