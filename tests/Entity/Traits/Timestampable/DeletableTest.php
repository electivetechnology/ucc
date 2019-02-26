<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\Deletable;
use PHPUnit\Framework\TestCase;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable\DeletableTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class DeletableTest extends TestCase
{
    public function testIsDeletable()
    {
        $now    = new \DateTime();
        $mock   = $this->getMockForTrait(Deletable::class);

        $this->assertInstanceOf(get_class($mock), $mock->setDeletedAt($now));
        $this->assertSame($now, $mock->getDeletedAt());
        $this->assertTrue(property_exists(Deletable::class, "deletedAt"));
    }
}
