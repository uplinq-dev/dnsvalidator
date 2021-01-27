<?php

namespace Einself\DnsValidator\Contracts;

use Einself\DnsValidator\Exception\ValidateException;

interface Validator
{
    /**
     * @param array $record
     * @return bool
     * @throws ValidateException
     */
    public function validate(array $record): bool;
}