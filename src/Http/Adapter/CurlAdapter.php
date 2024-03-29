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
namespace Xin\Aliyun\Core\Http\Adapter;

use Xin\Aliyun\Core\Constant;
use Xin\Aliyun\Core\Exception\ClientException;
use Xin\Aliyun\Core\Http\HttpResponse;

class CurlAdapter implements HttpAdapter
{
    public static $connectTimeout = 30; // 30 second

    public static $readTimeout = 80; // 80 second

    public function request($url, $httpMethod = 'GET', $postFields = null, $headers = null): HttpResponse
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
        if (Constant::ENABLE_HTTP_PROXY) {
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_PROXY, Constant::HTTP_PROXY_IP);
            curl_setopt($ch, CURLOPT_PROXYPORT, Constant::HTTP_PROXY_PORT);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? self::getPostHttpBody($postFields) : $postFields);

        if (self::$readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
        }
        if (self::$connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
        }
        // https request
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_array($headers) && 0 < count($headers)) {
            $httpHeaders = self::getHttpHearders($headers);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);
        }
        $httpResponse = new HttpResponse();
        $httpResponse->setBody(curl_exec($ch));
        $httpResponse->setStatus(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        if (curl_errno($ch)) {
            throw new ClientException('Server unreachable: Errno: ' . curl_errno($ch) . ' ' . curl_error($ch), 'SDK.ServerUnreachable');
        }
        curl_close($ch);
        return $httpResponse;
    }

    public static function getPostHttpBody($postFildes)
    {
        $content = '';
        foreach ($postFildes as $apiParamKey => $apiParamValue) {
            $content .= "{$apiParamKey}=" . urlencode($apiParamValue) . '&';
        }
        return substr($content, 0, -1);
    }

    public static function getHttpHearders($headers)
    {
        $httpHeader = [];
        foreach ($headers as $key => $value) {
            array_push($httpHeader, $key . ':' . $value);
        }
        return $httpHeader;
    }
}
