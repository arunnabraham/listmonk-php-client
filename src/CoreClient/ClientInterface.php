<?php

declare(strict_types=1);

namespace Neoxenos\ListMonkClient\CoreClient;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface {
    
    public function send(string $url, string $method, array $headers, string $body='', array $options=[]): ResponseInterface;
    
}