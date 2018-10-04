<?php

namespace ElectiveGroup\Ucc\Tests\Doctrine;

use PHPUnit\Framework\TestCase;
use ElectiveGroup\Ucc\Doctrine\GuidGeneratorException;
use ElectiveGroup\Ucc\Doctrine\GuidGenerator;

/**
 * ElectiveGroup\Ucc\Tests\Doctrine\GuidGeneratorTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class GuidGeneratorTest extends TestCase
{
    /**
     * @dataProvider indexNameProvider
     */
    public function testSetAndGetIndexName($index, $expected)
    {
        $generator = new GuidGenerator;

        $this->assertInstanceOf(GuidGenerator::class, $generator->setIndexName($index));
    }

    public function indexNameProvider()
    {
        return array(
            array(null, 'id'),
            array('guid', 'guid'),
        );
    }
}
