<?php

namespace Config;

class Locale
{
    private $timezone;

    public function __construct()
    {
        $timezone = 'Asia/Jakarta';
        $this->timezone = $timezone;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public static function now($dateTime = null)
    {
        $locale = new Locale();
        if ($dateTime) {
            // get value from $dateTime
            $date = date_create($dateTime, timezone_open($locale->getTimezone()));
            $date = date_format($date, 'Y-m-d H:i:s');
            return $date;
        } else {
            $now = new \DateTime('now', new \DateTimeZone($locale->getTimezone()));
            return $now->format('Y-m-d H:i:s');
        }
    }
}
