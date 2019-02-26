<?php

namespace ElectiveGroup\Ucc\Entity\Traits\Timestampable;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Timestampable\Updatable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait Updatable {
    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Get updatedAt
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param   $updatedAt DateTimeInterface
     * @return  self
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
