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
namespace Xin\Aliyun\Core;

use Xin\Aliyun\Core\Exception\ClientException;
use Xin\Aliyun\Core\Exception\ServerException;
use Xin\Aliyun\Core\Http\HttpHelper;
use Xin\Aliyun\Core\Regions\EndpointProvider;
use Xin\Aliyun\Core\Regions\LocationService;

class DefaultAcsClient implements IAcsClient
{
    public $iClientProfile;

    public $__urlTestFlag__;

    private $locationService;

    private $ramRoleArnService;

    private $ecsRamRoleService;

    public function __construct($iClientProfile)
    {
        $this->iClientProfile = $iClientProfile;
        $this->__urlTestFlag__ = false;
        $this->locationService = new LocationService($this->iClientProfile);
        if ($this->iClientProfile->isRamRoleArn()) {
            $this->ramRoleArnService = new RamRoleArnService($this->iClientProfile);
        }
        if ($this->iClientProfile->isEcsRamRole()) {
            $this->ecsRamRoleService = new EcsRamRoleService($this->iClientProfile);
        }
    }

    public function getAcsResponse($request, $iSigner = null, $credential = null, $autoRetry = true, $maxRetryNumber = 3)
    {
        $httpResponse = $this->doActionImpl($request, $iSigner, $credential, $autoRetry, $maxRetryNumber);
        $respObject = $this->parseAcsResponse($httpResponse->getBody(), $request->getAcceptFormat());
        if ($httpResponse->isSuccess() == false) {
            $this->buildApiException($respObject, $httpResponse->getStatus());
        }
        return $respObject;
    }

    public function doAction($request, $iSigner = null, $credential = null, $autoRetry = true, $maxRetryNumber = 3)
    {
        trigger_error('doAction() is deprecated. Please use getAcsResponse() instead.', E_USER_NOTICE);
        return $this->doActionImpl($request, $iSigner, $credential, $autoRetry, $maxRetryNumber);
    }

    private function doActionImpl($request, $iSigner = null, $credential = null, $autoRetry = true, $maxRetryNumber = 3)
    {
        if ($this->iClientProfile == null && ($iSigner == null || $credential == null
                || $request->getRegionId() == null || $request->getAcceptFormat() == null)) {
            throw new ClientException('No active profile found.', 'SDK.InvalidProfile');
        }
        if ($iSigner == null) {
            $iSigner = $this->iClientProfile->getSigner();
        }
        if ($credential == null) {
            $credential = $this->iClientProfile->getCredential();
        }
        if ($this->iClientProfile->isRamRoleArn()) {
            $credential = $this->ramRoleArnService->getSessionCredential();
        }
        if ($this->iClientProfile->isEcsRamRole()) {
            $credential = $this->ecsRamRoleService->getSessionCredential();
        }
        if ($credential == null) {
            throw new ClientException('Incorrect user credentials.', 'SDK.InvalidCredential');
        }

        $request = $this->prepareRequest($request);

        // Get the domain from the Location Service by speicified `ServiceCode` and `RegionId`.
        $domain = null;
        if ($request->getLocationServiceCode() != null) {
            $domain = $this->locationService->findProductDomain($request->getRegionId(), $request->getLocationServiceCode(), $request->getLocationEndpointType(), $request->getProduct());
        }
        if ($domain == null) {
            $domain = EndpointProvider::findProductDomain($request->getRegionId(), $request->getProduct());
        }

        if ($domain == null) {
            throw new ClientException('Can not find endpoint to access.', 'SDK.InvalidRegionId');
        }
        $requestUrl = $request->composeUrl($iSigner, $credential, $domain);

        if ($this->__urlTestFlag__) {
            throw new ClientException($requestUrl, 'URLTestFlagIsSet');
        }

        if (count($request->getDomainParameter()) > 0) {
            $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getDomainParameter(), $request->getHeaders());
        } else {
            $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getContent(), $request->getHeaders());
        }

        $retryTimes = 1;
        while (500 <= $httpResponse->getStatus() && $autoRetry && $retryTimes < $maxRetryNumber) {
            $requestUrl = $request->composeUrl($iSigner, $credential, $domain);

            if (count($request->getDomainParameter()) > 0) {
                $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getDomainParameter(), $request->getHeaders());
            } else {
                $httpResponse = HttpHelper::curl($requestUrl, $request->getMethod(), $request->getContent(), $request->getHeaders());
            }
            ++$retryTimes;
        }
        return $httpResponse;
    }

    private function prepareRequest($request)
    {
        if ($request->getRegionId() == null) {
            $request->setRegionId($this->iClientProfile->getRegionId());
        }
        if ($request->getAcceptFormat() == null) {
            $request->setAcceptFormat($this->iClientProfile->getFormat());
        }
        if ($request->getMethod() == null) {
            $request->setMethod('GET');
        }
        return $request;
    }

    private function buildApiException($respObject, $httpStatus)
    {
        throw new ServerException($respObject->Message, $respObject->Code, $httpStatus, $respObject->RequestId);
    }

    private function parseAcsResponse($body, $format)
    {
        if ($format == 'JSON') {
            $respObject = json_decode($body);
        } elseif ($format == 'XML') {
            $respObject = @simplexml_load_string($body);
        } elseif ($format == 'RAW') {
            $respObject = $body;
        }
        return $respObject;
    }
}
