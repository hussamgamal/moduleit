<?php
namespace MshMsh\Enum\SMTP;


class Encryption
{
    const SSL ='ssl';
    const TLS ='tls';
    const NONE ='none';

    const ALL_ENCRYPTION = [
        self::SSL => self::SSL,
        self::TLS => self::TLS,
        self::NONE=> self::NONE,
    ];
}
