<?php

namespace App\AbstractFactory\Classes;

use App\AbstractFactory\Interfaces\LabelInterface;

class SeriesLabel implements LabelInterface
{
    public function get(): string
    {
        return 'This is series';
    }
}