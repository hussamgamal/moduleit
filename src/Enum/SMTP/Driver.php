<?php
namespace MshMsh\Enum\SMTP;


class Driver
{
    const SMTP ='smtp';
    const SENDMAIL ='sendmail';
    const MAILGUN ='mailgun';
    const MAILHOG ='mailhog';
    const POSTMARK ='postmark';

    const ALL_DRIVERS = [
        self::SMTP=> self::SMTP,
        self::SENDMAIL => self::SENDMAIL,
        self::MAILHOG => self::MAILHOG,
        self::MAILGUN => self::MAILGUN,
        self::POSTMARK => self::POSTMARK,
    ];
}
