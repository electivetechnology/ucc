<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits;

use ElectiveGroup\Ucc\Entity\Traits\Progressable;
use PHPUnit\Framework\TestCase;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\ProgressableTest
 *
 * @author Chris Dixon <chris@electivegroup.com>
 */
class ProgressableTest extends TestCase
{
    public function testIsCreatable()
    {
        $progress = 'completed';
        $mock   = $this->getMockForTrait(Progressable::class);

        $this->assertSame($progress, $mock->getProgress());
        $this->assertTrue(property_exists(Progressable::class, "progress"));
    }
}
