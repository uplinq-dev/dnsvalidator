<?php

require_once __DIR__ . '/vendor/autoload.php';

$record = [
    'type' => 'SRV',
    'name' => '_ldap._tcp.example.com',
    'content' => '0 80 example.com',
    'prio' => '30',
];

$validator = new \Einself\DnsValidator\DnsValidator();
$result = $validator->validateRecord($record);

var_dump($result);