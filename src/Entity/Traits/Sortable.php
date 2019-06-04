<?php

namespace ElectiveGroup\Ucc\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Sortable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait Sortable {
    /**
     * @ORM\Column(name="order_index", type="smallint", nullable=true)
     */
    private $orderIndex;

    /**
     * Set orderIndex
     *
     * @param   $orderIndex
     * @return  Sortable
     */
    public function setOrderIndex($orderIndex = null): self
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    /**
     * Get orderIndex
     *
     * @return Sortable
     */
    public function getOrderIndex(): ?int
    {
        return $this->orderIndex;
    }
}
