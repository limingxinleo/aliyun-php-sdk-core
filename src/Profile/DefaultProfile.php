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

use Xin\Aliyun\Core\Auth\Credential;
use Xin\Aliyun\Core\Auth\EcsRamRoleCredential;
use Xin\Aliyun\Core\Auth\RamRoleArnCredential;
use Xin\Aliyun\Core\Auth\ShaHmac1Signer;
use Xin\Aliyun\Core\Constant;
use Xin\Aliyun\Core\Regions\EndpointProvider;
use Xin\Aliyun\Core\Regions\LocationService;
use Xin\Aliyun\Core\Regions\ProductDomain;

class DefaultProfile implements IClientProfile
{
    private static $profile;

    private static $endpoints;

    private static $credential;

    private static $regionId;

    private static $acceptFormat;

    private static $authType;

    private static $isigner;

    private static $iCredential;

    private function __construct($regionId, $credential, $authType = Constant::AUTH_TYPE_RAM_AK)
    {
        self::$regionId = $regionId;
        self::$credential = $credential;
        self::$authType = $authType;
    }

    public static function getProfile($regionId, $accessKeyId, $accessSecret, $securityToken = null)
    {
        $credential = new Credential($accessKeyId, $accessSecret, $securityToken);
        self::$profile = new DefaultProfile($regionId, $credential);
        return self::$profile;
    }

    public static function getRamRoleArnProfile($regionId, $accessKeyId, $accessSecret, $roleArn, $roleSessionName)
    {
        $credential = new RamRoleArnCredential($accessKeyId, $accessSecret, $roleArn, $roleSessionName);
        self::$profile = new DefaultProfile($regionId, $credential, Constant::AUTH_TYPE_RAM_ROLE_ARN);
        return self::$profile;
    }

    public static function getEcsRamRoleProfile($regionId, $roleName)
    {
        $credential = new EcsRamRoleCredential($roleName);
        self::$profile = new DefaultProfile($regionId, $credential, Constant::AUTH_TYPE_ECS_RAM_ROLE);
        return self::$profile;
    }

    public function getSigner()
    {
        if (self::$isigner == null) {
            self::$isigner = new ShaHmac1Signer();
        }
        return self::$isigner;
    }

    public function getRegionId()
    {
        return self::$regionId;
    }

    public function getFormat()
    {
        return self::$acceptFormat;
    }

    public function getCredential()
    {
        if (self::$credential == null && self::$iCredential != null) {
            self::$credential = self::$iCredential;
        }
        return self::$credential;
    }

    public function isRamRoleArn()
    {
        if (self::$authType == Constant::AUTH_TYPE_RAM_ROLE_ARN) {
            return true;
        }
        return false;
    }

    public function isEcsRamRole()
    {
        if (self::$authType == Constant::AUTH_TYPE_ECS_RAM_ROLE) {
            return true;
        }
        return false;
    }

    public static function getEndpoints()
    {
        if (self::$endpoints == null) {
            self::$endpoints = EndpointProvider::getEndpoints();
        }
        return self::$endpoints;
    }

    public static function addEndpoint($endpointName, $regionId, $product, $domain)
    {
        if (self::$endpoints == null) {
            self::$endpoints = self::getEndpoints();
        }
        $endpoint = self::findEndpointByName($endpointName);
        if ($endpoint == null) {
            self::addEndpoint_($endpointName, $regionId, $product, $domain);
        } else {
            self::updateEndpoint($regionId, $product, $domain, $endpoint);
        }

        LocationService::addEndPoint($regionId, $product, $domain);
    }

    public static function findEndpointByName($endpointName)
    {
        foreach (self::$endpoints ?? [] as $key => $endpoint) {
            if ($endpoint->getName() == $endpointName) {
                return $endpoint;
            }
        }
    }

    private static function addEndpoint_($endpointName, $regionId, $product, $domain)
    {
        $regionIds = [$regionId];
        $productsDomains = [new ProductDomain($product, $domain)];
        $endpoint = new Endpoint($endpointName, $regionIds, $productsDomains);
        array_push(self::$endpoints, $endpoint);
    }

    private static function updateEndpoint($regionId, $product, $domain, $endpoint)
    {
        $regionIds = $endpoint->getRegionIds();
        if (! in_array($regionId, $regionIds)) {
            array_push($regionIds, $regionId);
            $endpoint->setRegionIds($regionIds);
        }

        $productDomains = $endpoint->getProductDomains();
        if (self::findProductDomainAndUpdate($productDomains, $product, $domain) == null) {
            array_push($productDomains, new ProductDomain($product, $domain));
        }

        $endpoint->setProductDomains($productDomains);
    }

    private static function findProductDomainAndUpdate($productDomains, $product, $domain)
    {
        foreach ($productDomains as $key => $productDomain) {
            if ($productDomain->getProductName() == $product) {
                $productDomain->setDomainName($domain);
                return $productDomain;
            }
        }
        return null;
    }
}
