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
namespace SwoftTest\Testing\Ft;

use Xin\Aliyun\Core\RpcAcsRequest;

class TestRpcApiRequest extends RpcAcsRequest
{
    private $queryParam;

    private $bodyParam;

    public function __construct()
    {
        parent::__construct('Ft', '2016-01-01', 'TestRpcApi');
    }

    public function getQueryParam()
    {
        return $this->queryParam;
    }

    public function setQueryParam($queryParam)
    {
        $this->queryParam = $queryParam;
        $this->queryParameters['QueryParam'] = $queryParam;
    }

    public function getBodyParam()
    {
        return $this->bodyParam;
    }

    public function setBodyParam($bodyParam)
    {
        $this->bodyParam = $bodyParam;
        $this->queryParameters['BodyParam'] = $bodyParam;
    }
}
