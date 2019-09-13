<?php

namespace ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable;

/**
 * ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable\VisibilityMarkableInterface
 *
 * @author Kris Rybak <kris.rybak@elective.io>
 */
interface VisibilityMarkableInterface
{
    const VISIBILITY_PUBLIC     = 'public';
    const VISIBILITY_PROTECTED  = 'protected';
    const VISIBILITY_PRIVATE    = 'private';

    public static function getVisibilityOptions(): array;

    public function setVisibility(?string $visibility = null): ?self;

    public function getVisibility(): ?string;
}
