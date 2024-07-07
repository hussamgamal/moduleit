<?php
namespace MshMsh\Enum\SMTP;


class Port
{
    const PORT25 ='25';
    const PORT587 ='587';
    const PORT465 ='465';
    const PORT1025 ='1025';
    const PORT2525 ='2525';

    const ALL_PORTS = [
        self::PORT25 => self::PORT25,
        self::PORT587 => self::PORT587,
        self::PORT465 => self::PORT465,
        self::PORT1025 => self::PORT1025,
        self::PORT2525 => self::PORT2525,
    ];
}
