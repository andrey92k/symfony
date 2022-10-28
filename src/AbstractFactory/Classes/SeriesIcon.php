<?php

namespace App\AbstractFactory\Classes;

use App\AbstractFactory\Interfaces\IconInterface;

class SeriesIcon implements IconInterface
{
    public function get(): string
    {
        return "&#127909;";
    }
}