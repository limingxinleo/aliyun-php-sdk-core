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

use Xin\Aliyun\Core\Http\HttpResponse;

interface HttpAdapter
{
    public function request($url, $httpMethod = 'GET', $postFields = null, $headers = null): HttpResponse;
}
