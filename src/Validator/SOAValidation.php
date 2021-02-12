<?php

namespace Einself\DnsValidator\Validator;

use Einself\DnsValidator\Contracts\Validator;
use Einself\DnsValidator\Exception\ValidateException;

class SOAValidation implements Validator
{
    /**
     * @inheritdoc
     */
    public function validate(array $record): bool
    {
        if(!filter_var($record['name'], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
            throw new ValidateException('No valid name given.');

        if(!preg_match("/^(.*) (.*) ([0-9]+) ([0-9]+) ([0-9]+) ([0-9]+) ([0-9]+)$/", $record['content'], $matches))
            throw new ValidateException('No valid content given. (primary, mail, serial, refresh, retry, expiry, min)');

        if(!filter_var($matches[1], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
            throw new ValidateException('No valid primary given.');

        if(!filter_var($matches[2], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
            throw new ValidateException('No valid mail given.');

        // TODO: Check serial, refresh, retry, expiry, min

        return true;
    }
}