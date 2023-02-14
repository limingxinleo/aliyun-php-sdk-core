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
namespace Xin\Aliyun\Core\Regions;

use Xin\Aliyun\Core\Constant;
use Xin\Aliyun\Core\Http\HttpHelper;

class LocationService
{
    public static $cache = [];

    public static $lastClearTimePerProduct = [];

    public static $serviceDomain = Constant::LOCATION_SERVICE_DOMAIN;

    private $clientProfile;

    public function __construct($clientProfile)
    {
        $this->clientProfile = $clientProfile;
    }

    public function findProductDomain($regionId, $serviceCode, $endPointType, $product)
    {
        $key = $regionId . '#' . $product;
        @$domain = self::$cache[$key];
        if ($domain == null || $this->checkCacheIsExpire($key) == true) {
            $domain = $this->findProductDomainFromLocationService($regionId, $serviceCode, $endPointType);
            self::$cache[$key] = $domain;
        }

        return $domain;
    }

    public static function addEndPoint($regionId, $product, $domain)
    {
        $key = $regionId . '#' . $product;
        self::$cache[$key] = $domain;
        $lastClearTime = mktime(0, 0, 0, 1, 1, 2999);
        self::$lastClearTimePerProduct[$key] = $lastClearTime;
    }

    public static function modifyServiceDomain($domain)
    {
        self::$serviceDomain = $domain;
    }

    private function checkCacheIsExpire($key)
    {
        $lastClearTime = self::$lastClearTimePerProduct[$key] ?? null;
        if ($lastClearTime == null) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;
        }

        $now = time();
        $elapsedTime = $now - $lastClearTime;

        if ($elapsedTime > Constant::CACHE_EXPIRE_TIME) {
            $lastClearTime = time();
            self::$lastClearTimePerProduct[$key] = $lastClearTime;
            return true;
        }

        return false;
    }

    private function findProductDomainFromLocationService($regionId, $serviceCode, $endPointType)
    {
        $request = new DescribeEndpointRequest($regionId, $serviceCode, $endPointType);

        $signer = $this->clientProfile->getSigner();
        $credential = $this->clientProfile->getCredential();

        $requestUrl = $request->composeUrl($signer, $credential, self::$serviceDomain);

        $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), null, $request->getHeaders());

        if (! $httpResponse->isSuccess()) {
            return null;
        }

        $respObj = json_decode((string) $httpResponse->getBody());
        return $respObj->Endpoints->Endpoint[0]->Endpoint;
    }
}
