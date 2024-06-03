<?php

namespace App\Traits;

use Carbon\Carbon;

trait DatetimeTrait
{
    public function getDiffHumans($value)
    {
        setlocale(LC_TIME, 'ru_RU');
        Carbon::setLocale('ru');
        return Carbon::parse($value)->diffForHumans();
    }
    public function getFormattedDate($value)
    {
        setlocale(LC_TIME, 'ru_RU');
        Carbon::setLocale('ru');
        return Carbon::parse($value)->translatedFormat('d F Y');
    }
    public function getFormattedDateWithoutYear($value)
    {
        setlocale(LC_TIME, 'ru_RU');
        Carbon::setLocale('ru');
        return Carbon::parse($value)->translatedFormat('d F');
    }
}