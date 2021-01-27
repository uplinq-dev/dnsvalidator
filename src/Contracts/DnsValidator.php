<?php

namespace Einself\DnsValidator\Contracts;

use Einself\DnsValidator\Exception\ValidateException;

interface DnsValidator
{
    /**
     * @param array $record
     * @return bool
     * @throws ValidateException
     */
    public function validateRecord(array $record): bool;

    /**
     * @param array $zone
     * @return bool
     * @throws ValidateException
     */
    public function validateZone(array $zone): bool;
}