<?php

declare(strict_types=1);

namespace app\enums;

class CustomerQualityEnum
{
    public const QUALITY_ACTIVE = 'active';
    public const QUALITY_REJECTED = 'rejected';
    public const QUALITY_COMMUNITY = 'community';
    public const QUALITY_UNASSIGNED = 'unassigned';
    public const QUALITY_TRICKLE = 'trickle';
}
