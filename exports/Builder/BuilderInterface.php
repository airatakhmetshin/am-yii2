<?php

namespace app\exports\Builder;

interface BuilderInterface
{
    public function getFilePath(): string;
    public function appendHeader(array $columns): void;
    public function appendBody(array $rows);
}
