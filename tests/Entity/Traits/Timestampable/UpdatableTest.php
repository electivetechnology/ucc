<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\Updatable;
use PHPUnit\Framework\TestCase;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable\UpdatableTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class UpdatableTest extends TestCase
{
    public function testIsUpdatable()
    {
        $now    = new \DateTime();
        $mock   = $this->getMockForTrait(Updatable::class);

        $this->assertInstanceOf(get_class($mock), $mock->setUpdatedAt($now));
        $this->assertSame($now, $mock->getUpdatedAt());
        $this->assertTrue(property_exists(Updatable::class, "updatedAt"));
    }
}
