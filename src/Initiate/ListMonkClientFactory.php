<?php

declare(strict_types=1);

namespace Neoxenos\ListMonkClient\Initiate;

use Neoxenos\ListMonkClient\ListMonk\SendTransactionalMail;
use Symfony\Component\DependencyInjection\Container;

class ListMonkClientFactory {

    private Container $container;
    
    public function __construct(
        private string $username,
        private string $password,
        private string $baseurl
    )
    {
        $this->container = (new Bootstrap)->diLoader();

        $this->container->setParameter('username', $this->username);
        $this->container->setParameter('password', $this->password);
        $this->container->setParameter('baseurl', $this->baseurl);
    }
    public static function create(
        string $username,
        string $password,
        string $baseurl
    ): self {
        return new (self::class)($username, $password, $baseurl);
    }

    public function transactionMailAction(
        string $subscriberEmail,
        int $templateId,
        array $data,
        string $contentType = 'html'
    ): bool
    {
       $sendMailObject = $this->container->get('app.sendTransactionMail');
       assert($sendMailObject instanceof SendTransactionalMail);
       return ($sendMailObject)($subscriberEmail, $templateId, $data, $contentType);
    }
}