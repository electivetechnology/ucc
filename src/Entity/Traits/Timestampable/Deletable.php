<?php

namespace ElectiveGroup\Ucc\Entity\Traits\Timestampable;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Timestampable\Deletable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait Deletable {
    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Get deletedAt
     *
     * @return \DateTimeInterface
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     *
     * @param   $deletedAt DateTimeInterface
     * @return  self
     */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
