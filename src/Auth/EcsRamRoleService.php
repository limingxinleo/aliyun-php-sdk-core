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

class EcsRamRoleService
{
    private $clientProfile;

    private $lastClearTime;

    private $sessionCredential;

    public function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    public function getSessionCredential()
    {
        if ($this->lastClearTime != null && $this->sessionCredential != null) {
            $now = time();
            $elapsedTime = $now - $this->lastClearTime;
            if ($elapsedTime <= Constant::ECS_ROLE_EXPIRE_TIME * 0.8) {
                return $this->sessionCredential;
            }
        }

        $credential = $this->assumeRole();

        if ($credential == null) {
            return null;
        }

        $this->sessionCredential = $credential;
        $this->lastClearTime = time();

        return $credential;
    }

    private function assumeRole()
    {
        $ecsRamRoleCredential = $this->clientProfile->getCredential();

        $requestUrl = 'http://100.100.100.200/latest/meta-data/ram/security-credentials/' . $ecsRamRoleCredential->getRoleName();

        $httpResponse = HttpHelper::curl($requestUrl, 'GET', null, null);
        if (! $httpResponse->isSuccess()) {
            return null;
        }

        $respObj = json_decode($httpResponse->getBody());

        $code = $respObj->Code;
        if ($code != 'Success') {
            return null;
        }

        $sessionAccessKeyId = $respObj->AccessKeyId;
        $sessionAccessKeySecret = $respObj->AccessKeySecret;
        $securityToken = $respObj->SecurityToken;

        return new Credential($sessionAccessKeyId, $sessionAccessKeySecret, $securityToken);
    }
}
