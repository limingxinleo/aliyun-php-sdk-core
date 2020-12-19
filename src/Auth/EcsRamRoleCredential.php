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

class EcsRamRoleCredential extends AbstractCredential
{
    private $roleName;

    public function __construct($roleName)
    {
        $this->roleName = $roleName;
    }

    public function getAccessKeyId()
    {
        return null;
    }

    public function getAccessSecret()
    {
        return null;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

    public function getSecurityToken()
    {
        return null;
    }
}
