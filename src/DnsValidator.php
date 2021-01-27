<?php

namespace Einself\DnsValidator;

use Einself\DnsValidator\Contracts\DnsValidator as Base;
use Einself\DnsValidator\Contracts\Validator;
use Einself\DnsValidator\Exception\ValidateException;
use Einself\DnsValidator\Validator\AAAAValidation;
use Einself\DnsValidator\Validator\AValidation;
use Einself\DnsValidator\Validator\CNAMEValidation;
use Einself\DnsValidator\Validator\MXValidation;
use Einself\DnsValidator\Validator\NSValidation;
use Einself\DnsValidator\Validator\SOAValidation;
use Einself\DnsValidator\Validator\SRVValidation;
use Einself\DnsValidator\Validator\TXTValidation;

class DnsValidator implements Base
{
    protected $validator = [
        'SOA' => SOAValidation::class,
        'A' => AValidation::class,
        'AAAA' => AAAAValidation::class,
        'CNAME' => CNAMEValidation::class,
        'TXT' => TXTValidation::class,
        'MX' => MXValidation::class,
        'NS' => NSValidation::class,
        'SRV' => SRVValidation::class,
    ];

    /**
     * @param array $record
     * @return bool
     * @throws ValidateException
     */
    public function validateRecord(array $record): bool
    {
        $validatorClass = $this->validator[$record['type']] ?? null;

        if (!$validatorClass) {
            throw ValidateException::fromInvalidType($record['type']);
        }

        /** @var Validator $validator */
        $validator = new $validatorClass();

        return $validator->validate($record);
    }

    /**
     * @param array $zone
     * @return bool
     * @throws ValidateException
     */
    public function validateZone(array $zone): bool
    {
        foreach ($zone as $record) {
            self::validateRecord($record);
        }

        return true;
    }
}