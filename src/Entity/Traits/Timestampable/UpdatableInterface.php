<?php

namespace ElectiveGroup\Ucc\Entity\Traits\Timestampable;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Timestampable\UpdatableInterface
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
interface UpdatableInterface
{
    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self;
}
