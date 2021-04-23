<?php

namespace ElectiveGroup\Ucc\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Progressable
 *
 * @author Chris Dixon <chris@electivegroup.com>
 */
trait Progressable {
    /**
     * @ORM\Column(name="progress", type="string", length=128, nullable=true)
     */
    private $progress;

    /**
     * Set progress
     *
     * @param   $progress
     * @return  Progressable
     */
    public function setProgress($progress = null): self
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return Progressable
     */
    public function getProgress(): ?string
    {
        return $this->progress;
    }
}
