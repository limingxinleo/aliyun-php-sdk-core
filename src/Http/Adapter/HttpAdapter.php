<?php

namespace Xin\Aliyun\Core\Http\Adapter;

use Xin\Aliyun\Core\Http\HttpResponse;

interface HttpAdapter
{
    public function request($url, $httpMethod = 'GET', $postFields = null, $headers = null): HttpResponse;
}