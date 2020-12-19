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

class EndpointProvider
{
    private static $endpoints;

    public static function findProductDomain($regionId, $product)
    {
        if ($regionId == null || $product == null || self::$endpoints == null) {
            return null;
        }
        foreach (self::$endpoints as $key => $endpoint) {
            if (in_array($regionId, $endpoint->getRegionIds())) {
                return self::findProductDomainByProduct($endpoint->getProductDomains(), $product);
            }
        }
        return null;
    }

    public static function getEndpoints()
    {
        return self::$endpoints;
    }

    public static function setEndpoints($endpoints)
    {
        self::$endpoints = $endpoints;
    }

    private static function findProductDomainByProduct($productDomains, $product)
    {
        if ($productDomains == null) {
            return null;
        }
        foreach ($productDomains as $key => $productDomain) {
            if ($product == $productDomain->getProductName()) {
                return $productDomain->getDomainName();
            }
        }
        return null;
    }
}
