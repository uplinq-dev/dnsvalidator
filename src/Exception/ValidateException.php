<?php

namespace Einself\DnsValidator\Exception;

use Exception;

class ValidateException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public static function fromInvalidType($type): self
    {
        return new self("Type '{$type}' is not available.");
    }

    public function __toString() {
        return __CLASS__ . ": {$this->message}\n";
    }
}