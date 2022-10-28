<?php

namespace App\AbstractFactory\Interfaces;

interface GuiFactoryInterface
{
    public function createIcon(): IconInterface;
    public function createLabel(): LabelInterface;
}