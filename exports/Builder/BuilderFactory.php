<?php

declare(strict_types=1);

namespace app\exports\Builder;

use app\enums\ExportTypeEnum;
use app\exceptions\exports\UnsupportedExportTypeException;

class BuilderFactory
{
    /**
     * @throws UnsupportedExportTypeException
     */
    public static function createBuilder(string $exportType, string $filename): BuilderInterface
    {
        switch ($exportType) {
            case ExportTypeEnum::CSV:
                return new CsvBuilder($filename);
            default:
                throw new UnsupportedExportTypeException();
        }
    }
}
