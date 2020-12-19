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

class ShaHmac1Signer implements ISigner
{
    public function signString($source, $accessSecret)
    {
        return base64_encode(hash_hmac('sha1', $source, $accessSecret, true));
    }

    public function getSignatureMethod()
    {
        return 'HMAC-SHA1';
    }

    public function getSignatureVersion()
    {
        return '1.0';
    }
}
