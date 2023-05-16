<?php

declare(strict_types=1);

namespace Neoxenos\ListMonkClient\Auth;

use Neoxenos\ListMonkClient\Config\InputSetConfig as ConfigInputSetConfig;

class Authable {

    public function __construct(
        private ConfigInputSetConfig $inputConfig
    )
    {
        
    }
    public function basic(): array
    {
        return [
                $this->inputConfig->username,
                $this->inputConfig->password
        ];
    }
}