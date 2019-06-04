<?php

namespace ElectiveGroup\Ucc\Entity\Traits;

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
     * @return array                    List of sorted items
     */
    public function sortCollection(
        PersistentCollection $collection,
        array $list = array(),
        $i = 1
    ): array {
        $sorted = array();

        if (!empty($list)) {
            foreach ($collection as $item) {
                // Check item is in the ordered list and retrieve its key (orderIndex)
                $key = array_search($item, $list);

                if ($key !== false) {
                    // Assign new order index
                    $orderIndex = $key + $i;
                    if ($item->getOrderIndex() != $orderIndex) {
                        $sorted[] = $item->setOrderIndex($orderIndex);
                    }
                } else {
                    // Remove old order index and set item as unordered
                    if (!is_null($item->getOrderIndex())) {
                        $sorted[] = $item->setOrderIndex(null);
                    }
                }
            }
        }

        return $sorted;
    }
}
