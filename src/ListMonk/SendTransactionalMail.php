<?php
declare(strict_types=1);

namespace Neoxenos\ListMonkClient\ListMonk;

use Neoxenos\ListMonkClient\Auth\Authable;
use Neoxenos\ListMonkClient\Config\HttpClient;
use Psr\Http\Message\ResponseInterface;

class SendTransactionalMail {

    const ENDPOINT = '/api/tx';
    const SEND_METHOD = 'POST';

    private array $headers = [];

    public function __construct(
        private readonly Authable $auth,
        private readonly HttpClient $client,
        private array $data = []
    ){
    }

    public function __invoke(string $subscriberEmail, int $templateId, array $data, string $contentType): bool
    {
        $this->setPayload(
            $subscriberEmail,
            $templateId,
            $data,
            $contentType
        );

        $this->setHeaders();

       $response = ($this->client)()->send(
                self::ENDPOINT,
            self::SEND_METHOD,
            $this->headers,
            $this->getPayLoad(),
            [
                'auth' => $this->auth->basic()
            ]
        );

        if($response instanceof ResponseInterface)
        {
            if($response->getStatusCode() === 200 && json_decode($response->getBody()->getContents())->data)
            {
                return true;
            }
        }
        return false;

    }

    private function setPayload(string $subscriberEmail, int $templateId, array $data, string $contentType): void
    {
        $this->data = [
            'subscriber_email' => $subscriberEmail,
            'template_id' => $templateId,
            'data' => $data,
            'content_type' => $contentType
        ];
    }

    private function getPayLoad(): string
    {
        return json_encode($this->data, JSON_THROW_ON_ERROR, 512);
    }

    private function setHeaders(): void
    {
        $this->headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept' => 'application/json',
            'Content-Length' => mb_strlen($this->getPayLoad())
        ];
    }
}