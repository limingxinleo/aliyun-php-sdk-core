<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Testing\Ft;

use Xin\Aliyun\Core\RoaAcsRequest;

class TestRoaApiRequest extends RoaAcsRequest
{
    public function __construct()
    {
        parent::__construct('Ft', '2016-01-02', 'TestRoaApi');
        $this->setUriPattern('/web/cloudapi');
        $this->setMethod('GET');
    }

    private $queryParam;

    private $bodyParam;

    private $headerParam;

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

    public function getHeaderParam()
    {
        return $this->headerParam;
    }

    public function setHeaderParam($headerParam)
    {
        $this->headerParam = $headerParam;
        $this->headerParam['HeaderParam'] = $headerParam;
    }
}
