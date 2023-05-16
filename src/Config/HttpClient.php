<?php
declare(strict_types=1);

namespace Neoxenos\ListMonkClient\Config;

use Neoxenos\ListMonkClient\CoreClient\ClientInterface;
use Neoxenos\ListMonkClient\CoreClient\Clients\GuzzleClient as ClientsGuzzleClient;

class HttpClient {

    const DEFAULT_HTTP_CLIENT = 'guzzle';

    public function __construct(
        private readonly ClientsGuzzleClient $guzzle
    ){   
    }

    public function __invoke(): ClientInterface {
        
        return $this->{self::DEFAULT_HTTP_CLIENT};
    }

}