<?php

namespace ElectiveGroup\Ucc\Entity\Traits;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\Updatable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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

    /**
     * Sorts collection
     *
     * @param   PersistentCollection    $collection     collection to sort
     * @param   array                   $list           ordered list
     * @param   int                     $i              Initial index, default 1
     * @return array
     */
    public function sortCollection(
        PersistentCollection $collection,
        array $list = array(),
        $i = 1
    ): PersistentCollection {
        if (!empty($list)) {
            foreach ($collection as $item) {
                $key = array_search($item, $list);
                if ($key !== false) {
                    $item->setOrderIndex($key + $i);
                } else {
                    $item->setOrderIndex(null);
                }

                if ($item instanceof UpdatableInterface) {
                    $item->setUpdatedAt(new DateTime());
                }
            }
        }

        return $collection;
    }
}
