<?php

namespace App\AbstractFactory\Factories;

use App\AbstractFactory\Classes\SeriesIcon;
use App\AbstractFactory\Classes\SeriesLabel;
use App\AbstractFactory\Interfaces\GuiFactoryInterface;
use App\AbstractFactory\Interfaces\IconInterface;
use App\AbstractFactory\Interfaces\LabelInterface;

class SeriesFactory implements GuiFactoryInterface
{
    public function createIcon(): IconInterface
    {
        return new SeriesIcon();
    }

    public function createLabel(): LabelInterface
    {
        return new SeriesLabel();
    }
}