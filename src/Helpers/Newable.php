<?php

namespace MshMsh\Helpers;

trait Newable
{
    public static function new(...$args)
    {
        return new static(...$args);
    }
}
