<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
class BaseTest extends PHPUnit_Framework_TestCase
{
    public $client = null;

    public function setUp()
    {
        $path = substr(dirname(__FILE__), 0, strripos(dirname(__FILE__), DIRECTORY_SEPARATOR)).DIRECTORY_SEPARATOR;
        include_once $path.'Config.php';
        include_once 'Ecs/Rquest/DescribeRegionsRequest.php';
        include_once 'BatchCompute/ListImagesRequest.php';

        $iClientProfile = DefaultProfile::getProfile('cn-hangzhou', 'AccessKey', 'AccessSecret');
        $this->client = new DefaultAcsClient($iClientProfile);
    }
    
    public function getProperty($propertyKey)
    {
        $accessKey = '';
        $accessSecret = '';
        $iClientProfile = DefaultProfile::getProfile('cn-hangzhou', 'AccessKey', 'AccessSecret');
    }
}
