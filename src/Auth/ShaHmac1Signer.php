<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
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
