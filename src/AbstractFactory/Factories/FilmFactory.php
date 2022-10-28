<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Classes\FilmIcon;
use App\AbstractFactory\Classes\FilmLabel;
use App\AbstractFactory\Interfaces\GuiFactoryInterface;
use App\AbstractFactory\Interfaces\IconInterface;
use App\AbstractFactory\Interfaces\LabelInterface;

class FilmFactory implements GuiFactoryInterface
{
    public function createIcon(): IconInterface
    {
        return new FilmIcon();
    }

    public function createLabel(): LabelInterface
    {
        return new FilmLabel();
    }
}