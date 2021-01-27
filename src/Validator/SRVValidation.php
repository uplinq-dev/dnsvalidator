<?php

namespace Einself\DnsValidator\Validator;

use Einself\DnsValidator\Contracts\Validator;
use Einself\DnsValidator\Exception\ValidateException;

class SRVValidation implements Validator
{
    /**
     * @inheritdoc
     */
    public function validate(array $record): bool
    {
        if(!filter_var($record['name'], FILTER_VALIDATE_DOMAIN))
            throw new ValidateException('No valid name given.');

        if(!preg_match("/^([1-9][0-9]{0,4}|0) ([1-9][0-9]{0,4}|0) (.*)$/", $record['content'], $matches))
            throw new ValidateException('No valid content given. (weight, port, destination)');

        if(!filter_var($matches[3], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
            throw new ValidateException('No valid destination given. (CNAME)');

        if(!preg_match("/^([1-9][0-9]{0,4}|0)$/", $record['prio']))
            throw new ValidateException("No valid priority given.");

        return true;
    }
}