<?php

namespace app\widgets\HistoryList\builders;

interface ItemBuilderInterface
{
    public function toRender(): array;
}
