<?php

namespace Neoxenos\ListMonkClient\Config;

class InputSetConfig {

    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $baseUrl
    ){}
}