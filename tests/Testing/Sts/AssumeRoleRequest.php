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
namespace SwoftTest\Testing\Sts;

use Xin\Aliyun\Core\RpcAcsRequest;

class AssumeRoleRequest extends RpcAcsRequest
{
    private $durationSeconds;

    private $policy;

    private $roleArn;

    private $roleSessionName;

    public function __construct()
    {
        parent::__construct('Sts', '2015-04-01', 'AssumeRole');
        $this->setProtocol('https');
    }

    public function getDurationSeconds()
    {
        return $this->durationSeconds;
    }

    public function setDurationSeconds($durationSeconds)
    {
        $this->durationSeconds = $durationSeconds;
        $this->queryParameters['DurationSeconds'] = $durationSeconds;
    }

    public function getPolicy()
    {
        return $this->policy;
    }

    public function setPolicy($policy)
    {
        $this->policy = $policy;
        $this->queryParameters['Policy'] = $policy;
    }

    public function getRoleArn()
    {
        return $this->roleArn;
    }

    public function setRoleArn($roleArn)
    {
        $this->roleArn = $roleArn;
        $this->queryParameters['RoleArn'] = $roleArn;
    }

    public function getRoleSessionName()
    {
        return $this->roleSessionName;
    }

    public function setRoleSessionName($roleSessionName)
    {
        $this->roleSessionName = $roleSessionName;
        $this->queryParameters['RoleSessionName'] = $roleSessionName;
    }
}
