<?php

declare(strict_types=1);

namespace app\translations;

abstract class BaseTranslation
{
    public static function getText($value): ?string
    {
        return static::map()[$value] ?? null;
    }

    abstract public static function map(): array;
}
