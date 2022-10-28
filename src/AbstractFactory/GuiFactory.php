<?php

namespace App\AbstractFactory;

use App\AbstractFactory\Factories\FilmFactory;
use App\AbstractFactory\Factories\SeriesFactory;
use App\AbstractFactory\Interfaces\GuiFactoryInterface;

class GuiFactory
{
    public function getFactory($type): GuiFactoryInterface
    {
        switch ($type) {
            case 'movie':
                $factory = new FilmFactory();
                break;
            case 'series':
                $factory = new SeriesFactory();
                break;
            default:
                $factory = new FilmFactory();
        }

        return $factory;
    }
}