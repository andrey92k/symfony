<?php

namespace App\AbstractFactory\Classes;

use App\AbstractFactory\Interfaces\LabelInterface;

class FilmLabel implements LabelInterface
{
    public function get(): string
    {
        return 'This is film';
    }
}