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
namespace Xin\Aliyun\Core\Auth;

use Xin\Aliyun\Core\Constant;
use Xin\Aliyun\Core\RpcAcsRequest;

class AssumeRoleRequest extends RpcAcsRequest
{
    public function __construct($roleArn, $roleSessionName)
    {
        parent::__construct(Constant::STS_PRODUCT_NAME, Constant::STS_VERSION, Constant::STS_ACTION);

        $this->queryParameters['RoleArn'] = $roleArn;
        $this->queryParameters['RoleSessionName'] = $roleSessionName;
        $this->queryParameters['DurationSeconds'] = Constant::ROLE_ARN_EXPIRE_TIME;
        $this->setRegionId(Constant::STS_REGION);
        $this->setProtocol('https');

        $this->setAcceptFormat('JSON');
    }
}
