<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Command;

interface Command
{
    public function getId(): string;
    public function getCommands(): array;
}
