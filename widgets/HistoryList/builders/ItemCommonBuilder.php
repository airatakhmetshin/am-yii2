<?php

declare(strict_types=1);

namespace app\widgets\HistoryList\builders;

use app\models\User;

class ItemCommonBuilder extends ItemBuilder
{
    /** @var string $body */
    protected $body;

    /** @var string $bodyDatetime */
    protected $bodyDatetime;

    /** @var string $content */
    protected $content;

    /** @var string $footer */
    protected $footer;

    /** @var string $footerDatetime */
    protected $footerDatetime;

    /** @var string $iconClass */
    protected $iconClass;

    /** @var bool $iconIncome */
    protected $iconIncome;

    /** @var ?User $user */
    protected $user;

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setBodyDatetime(string $bodyDatetime): self
    {
        $this->bodyDatetime = $bodyDatetime;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    public function setFooterDatetime(string $footerDatetime): self
    {
        $this->footerDatetime = $footerDatetime;

        return $this;
    }

    public function setIconClass(string $iconClass): self
    {
        $this->iconClass = $iconClass;

        return $this;
    }

    public function setIconIncome(bool $iconIncome): self
    {
        $this->iconIncome = $iconIncome;

        return $this;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
