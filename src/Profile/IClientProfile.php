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
namespace Xin\Aliyun\Core\Profile;

interface IClientProfile
{
    public function getSigner();

    public function getRegionId();

    public function getFormat();

    public function getCredential();

    public function isRamRoleArn();

    public function isEcsRamRole();
}
