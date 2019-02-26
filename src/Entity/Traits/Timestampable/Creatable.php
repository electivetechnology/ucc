<?php

namespace ElectiveGroup\Ucc\Entity\Traits\Timestampable;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Timestampable\Creatable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait Creatable {
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param   $createdAt DateTimeInterface
     * @return  self
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
