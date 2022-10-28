<?php

namespace App\AbstractFactory\Classes;

use App\AbstractFactory\Interfaces\IconInterface;

class FilmIcon implements IconInterface
{
    public function get(): string
    {
        return '&#127902;';
    }
}