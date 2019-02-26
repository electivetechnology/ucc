<?php

namespace ElectiveGroup\Ucc\Entity\Traits\Timestampable;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\{Creatable, Updatable, Deletable};
use Doctrine\ORM\Mapping as ORM;

/**
 * ElectiveGroup\Ucc\Entity\Traits\Timestampable\Timestampable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait Timestampable {
    use Creatable, Updatable, Deletable;
}
