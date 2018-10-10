<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */
namespace SwoftTest\Testing\BatchCompute;

use Xin\Aliyun\Core\RoaAcsRequest;

class ListImagesRequest extends RoaAcsRequest
{
    public function __construct()
    {
        parent::__construct('BatchCompute', '2013-01-11', 'ListImages');
        $this->setUriPattern('/images');
        $this->setMethod('GET');
    }
}
