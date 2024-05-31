<?php

declare(strict_types=1);

namespace app\enums;

class SmsStatusEnum
{
    // incoming
    public const STATUS_NEW = 0;
    public const STATUS_READ = 1;
    public const STATUS_ANSWERED = 2;

    // outgoing
    public const STATUS_DRAFT = 10;
    public const STATUS_WAIT = 11;
    public const STATUS_SENT = 12;
    public const STATUS_DELIVERED = 13;
    public const STATUS_FAILED = 14;
    public const STATUS_SUCCESS = 13;
}
