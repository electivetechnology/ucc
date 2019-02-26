<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable;

use ElectiveGroup\Ucc\Entity\Traits\Timestampable\Timestampable;
use PHPUnit\Framework\TestCase;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\Timestampable\TimestampableTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class TimestampableTest extends TestCase
{
    public function testIsTimestampable()
    {
        $now    = new \DateTime();
        $mock   = $this->getMockForTrait(Timestampable::class);

        $this->assertInstanceOf(get_class($mock), $mock->setCreatedAt($now));
        $this->assertSame($now, $mock->getCreatedAt());

        $this->assertInstanceOf(get_class($mock), $mock->setUpdatedAt($now));
        $this->assertSame($now, $mock->getUpdatedAt());

        $this->assertInstanceOf(get_class($mock), $mock->setDeletedAt($now));
        $this->assertSame($now, $mock->getDeletedAt());
    }
}
