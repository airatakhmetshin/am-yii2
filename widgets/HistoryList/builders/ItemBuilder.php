<?php

declare(strict_types=1);

namespace app\widgets\HistoryList\builders;

abstract class ItemBuilder implements ItemBuilderInterface
{
    public function toRender(): array
    {
        $params = [];

        foreach ($this as $property => $value) {
            if (isset($value)) {
                $params[$property] = $value;
            }
        }

        return $params;
    }
}
