<?php

namespace ElectiveGroup\Ucc\Tests\Entity\Traits\VisibilityMarkable;

use ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable\VisibilityMarkable;
use PHPUnit\Framework\TestCase;
use Ucc\Exception\Data\InvalidDataValueException;

/**
 * ElectiveGroup\Ucc\Tests\Entity\Traits\VisibilityMarkable\VisibilityMarkableTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class VisibilityMarkableTest extends TestCase
{
    public function visibilityProvider()
    {
        return [
            ['private'],
            ['protected'],
            ['public'],
        ];
    }

    /**
     * @dataProvider visibilityProvider
     */
    public function testIsVisibilityMarkable($visibility)
    {
        $mock = $this->getMockForTrait(VisibilityMarkable::class);

        $this->assertInstanceOf(get_class($mock), $mock->setVisibility($visibility));
        $this->assertSame($visibility, $mock->getVisibility());
        $this->assertTrue(property_exists(VisibilityMarkable::class, "visibility"));
    }

    public function testCheckIsValidVisibilityPass()
    {
        $mock = $this->getMockForTrait(VisibilityMarkable::class);

        foreach (VisibilityMarkable::getVisibilityOptions() as $visibility) {
            $this->assertEquals($visibility, $mock->checkIsValidVisibility($visibility));
        }
    }

    public function invalidVisibilityProvider()
    {
        return [
            ['notprivate'],
            ['notprotected'],
            ['notpublic'],
            ['123456'],
        ];
    }

    /**
     * @dataProvider invalidVisibilityProvider
     */
    public function testCheckIsValidVisibilityFail($visibility)
    {
        $this->expectException(InvalidDataValueException::class);
        $mock = $this->getMockForTrait(VisibilityMarkable::class);

        $this->assertEquals($visibility, $mock->checkIsValidVisibility($visibility));
    }
}
