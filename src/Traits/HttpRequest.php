<?php

/*
 * This file is part of the jassue/pdd-duoduoke.
 *
 * (c) jassue <jassue@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jassue\DuoDuoKe\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

trait HttpRequest
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected static $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4, // Solve the problem of IPv6 resolution failure delay
        ],
    ];

    /**
     * Get GuzzleHttp\ClientInterface instance.
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }

    /**
     * Make a request.
     *
     * @param $url
     * @param string $method
     * @param array $options
     * @return ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($url, $method = 'GET', $options = []): ResponseInterface
    {
        $method = strtoupper($method);

        $options = array_merge(self::$defaults, $options);

        if (property_exists($this, 'baseUri') && !is_null($this->baseUri)) {
            $options['base_uri'] = $this->baseUri;
        }

        $response = $this->getHttpClient()->request($method, $url, $options);
        $response->getBody()->rewind();

        return $response;
    }
}
