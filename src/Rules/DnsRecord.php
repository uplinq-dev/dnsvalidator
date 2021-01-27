<?php

namespace Einself\DnsValidator\Rules;

use Illuminate\Contracts\Validation\Rule;
use Einself\DnsValidator\Contracts\DnsValidator;
use Einself\DnsValidator\Exception\ValidateException;

class DnsRecord implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var DnsValidator $dnsValidator */
        $dnsValidator = app(DnsValidator::class);

        try {
            return $dnsValidator->validateRecord($value);
        } catch (ValidateException $exception) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be valid dns record.';
    }
}