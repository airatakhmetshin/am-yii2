<?php

declare(strict_types=1);

namespace app\exports\Builder;

class CsvBuilder implements BuilderInterface
{
    /** @var false|resource $file */
    protected $file;

    /** @var string $filePath */
    protected $filePath;

    public function __construct(string $filename)
    {
        $this->filePath = sprintf('%s/%s.csv', sys_get_temp_dir(), $filename);

        $this->file = fopen($this->filePath, 'wb');
    }

    public function __destruct()
    {
        fclose($this->file);
        unlink($this->filePath);
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function appendHeader(array $columns): void
    {
        fwrite($this->file, self::makeLine($columns));
    }

    public function appendBody(array $rows): void
    {
        foreach ($rows as $fields) {
            fwrite($this->file, self::makeLine($fields));
        }
    }

    /**
     * Fix double quotes
     */
    protected static function makeLine(array $columns): string
    {
        $rows = array_map(static function (string $column): string {
            return sprintf('"%s"', $column);
        }, $columns);

        return implode(',', $rows) . PHP_EOL;
    }
}
