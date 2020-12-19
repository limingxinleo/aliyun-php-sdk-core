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
namespace Xin\Aliyun\Core\Http;

use Xin\Aliyun\Core\Http\Adapter\CurlAdapter;
use Xin\Aliyun\Core\Http\Adapter\HttpAdapter;

class HttpHelper
{
    /** @var HttpAdapter */
    public static $adapter;

    public static function curl($url, $httpMethod = 'GET', $postFields = null, $headers = null)
    {
        if (empty(static::$adapter) || ! static::$adapter instanceof HttpAdapter) {
            static::$adapter = new CurlAdapter();
            return static::$adapter->request($url, $httpMethod, $postFields, $headers);
        }

        return static::$adapter->request($url, $httpMethod, $postFields, $headers);
    }
}
