<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
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
