<?php

namespace Einself\DnsValidator\Validator;

use Einself\DnsValidator\Contracts\Validator;
use Einself\DnsValidator\Exception\ValidateException;
use Einself\DnsValidator\Helper\Helper;

class AValidation implements Validator
{
    /**
     * @inheritdoc
     */
    public function validate(array $record): bool
    {
        if (Helper::startsWith($record['name'], '*.'))
            $record['name'] = substr($record['name'], 2);

        if (!filter_var($record['name'], FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
            throw new ValidateException('No valid name given.');

        if (!filter_var($record['content'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
            throw new ValidateException('No valid IPv4 given.');

        return true;
    }
}