<?php

namespace Artem\PhpFramework\Tests;

class Foo
{
    public function __construct(
        private readonly Telegram $telegram,
        private readonly Youtube $youtube
    ) {
    }
    public function getTelegram()
    {
        return $this->telegram;
    }

    public function getYoutube()
    {
        return $this->youtube;
    }
}
