<?php

declare(strict_types=1);

namespace app\widgets\HistoryList\builders;

use app\models\History;

class ItemStatusesChangeBuilder extends ItemBuilder
{
    /** @var History $model */
    protected $model;

    /** @var ?string $oldValue */
    protected $oldValue;

    /** @var ?string $newValue */
    protected $newValue;

    public function setModel(History $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setOldValue(?string $oldValue): self
    {
        $this->oldValue = $oldValue;

        return $this;
    }

    public function setNewValue(?string $newValue): self
    {
        $this->newValue = $newValue;

        return $this;
    }
}
