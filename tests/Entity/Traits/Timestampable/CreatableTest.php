<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\Creatable;
use PHPUnit\Framework\TestCase;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable\CreatableTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class CreatableTest extends TestCase
{
    public function testIsCreatable()
    {
        $now    = new \DateTime();
        $mock   = $this->getMockForTrait(Creatable::class);

        $this->assertInstanceOf(get_class($mock), $mock->setCreatedAt($now));
        $this->assertSame($now, $mock->getCreatedAt());
        $this->assertTrue(property_exists(Creatable::class, "createdAt"));
    }
}
