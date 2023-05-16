# Listmonk PHP Client

### Usage Simple Steps

#### Installation

```
composer require Neoxenos/listmonk-php-client

```

example: Transactional Mail

ref: https://listmonk.app/docs/apis/transactional/

```php

<?php

require_once __DIR__ . '/vendor/autoload.php';

use Neoxenos\ListMonkClient\Initiate\ListMonkClientFactory;

$credentails = [
    'listmonk-user',
    'listmonk-password',
    'https://base-url.com'
];


//factory call
$listmonkClient = ListMonkClientFactory::create(
...$credentails
);


$response = $listmonkClient->transactionMailAction(
    'user@example.com', // to emal
    5, //template number //refer admin (should be transactional mail type)
    [
        'order_id' => '1234',
        'name' => 'Name'
    ]
);


```
