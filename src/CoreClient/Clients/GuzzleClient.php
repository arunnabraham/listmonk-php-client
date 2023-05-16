<?php

declare(strict_types=1);

namespace Neoxenos\ListMonkClient\CoreClient\Clients;

use Neoxenos\ListMonkClient\Config\InputSetConfig as ConfigInputSetConfig;
use Neoxenos\ListMonkClient\CoreClient\ClientInterface as CoreClientClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements CoreClientClientInterface {

    public function __construct(
        private readonly Client $client,
        private readonly ConfigInputSetConfig $inputSetConfig,
        ){}
    
    public function send(
        string $endPoint,
        string $method,
        array $headers,
        string $body='',
        array $options=[]
        ): ResponseInterface {

        $request = new Request(
            $method,
            sprintf('%s%s', $this->inputSetConfig->baseUrl, $endPoint),
            $headers,
            $body === '' ? null : $body,
        );
        return $this->client->send(
            $request,
            $options
        );
    }
}