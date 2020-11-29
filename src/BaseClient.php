<?php

/*
 * This file is part of the jassue/pdd-duoduoke.
 *
 * (c) jassue <jassue@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jassue\DuoDuoKe;

use Jassue\DuoDuoKe\Traits\HttpRequest;

class BaseClient
{
    use HttpRequest { request as httpRequest; }

    /**
     * @var string
     */
    protected $baseUri = 'https://gw-api.pinduoduo.com/api/router';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * BaseClient constructor.
     * @param $clientId
     * @param $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Get signature.
     *
     * @param $params
     * @return string
     */
    private function getSignature($params): string
    {
        ksort($params);
        $paramsStr = '';
        array_walk($params, function ($item, $key) use (&$paramsStr) {
            if ('@' != substr($item, 0, 1)) {
                $paramsStr .= sprintf('%s%s', $key, $item);
            }
        });
        return strtoupper(md5(sprintf('%s%s%s', $this->clientSecret, $paramsStr, $this->clientSecret)));
    }

    /**
     * @param $method
     * @param $params
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $params): array
    {
        $params = $this->paramsHandle($params);
        $params['type'] = $method;
        $params['client_id'] = $this->clientId;
        $params['timestamp'] = strval(time());;
        $params['data_type'] = 'JSON';
        $params['sign_method'] = 'md5';
        $params['sign'] = $this->getSignature($params);
        $response = $this->httpRequest('', 'POST', [
            'form_params' => $params
        ]);
        $array = json_decode($response->getBody()->getContents(), true, 512, JSON_BIGINT_AS_STRING);
        $response->getBody()->rewind();
        if (JSON_ERROR_NONE === json_last_error()) {
            return (array) $array;
        }
        return [];
    }

    /**
     * Parameter processing.
     *
     * @param array $params
     * @return array
     */
    protected function paramsHandle(array $params): array
    {
        array_walk($params, function (&$item) {
            if (is_array($item)) {
                $item = json_encode($item);
            }
            if (is_bool($item)) {
                $item = ['false', 'true'][intval($item)];
            }
        });

        return $params;
    }
}
