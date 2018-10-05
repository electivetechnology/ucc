<?php

namespace ElectiveGroup\Ucc\Tests\Doctrine;

use PHPUnit\Framework\TestCase;
use ElectiveGroup\Ucc\Doctrine\GuidGeneratorException;
use ElectiveGroup\Ucc\Doctrine\GuidGenerator;
use ElectiveGroup\Ucc\Tests\Doctrine\IdEntity;

/**
 * ElectiveGroup\Ucc\Tests\Doctrine\GuidGeneratorTest
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
class GuidGeneratorTest extends TestCase
{
    public function testDefaultSettigns()
    {
        $generator = new GuidGenerator;

        $this->assertEquals(GuidGenerator::DEFAULT_INDEX, $generator->getIndexName());
        $this->assertEquals(GuidGenerator::DEFAULT_MAX_ATTEMPTS, $generator->getMaxAttempts());
    }

    /**
     * @dataProvider indexNameProvider
     */
    public function testSetAndGetIndexName($index, $expected)
    {
        $generator = new GuidGenerator;

        $this->assertInstanceOf(GuidGenerator::class, $generator->setIndexName($index));

        $this->assertEquals($expected, $generator->getIndexName());
    }

    public function indexNameProvider()
    {
        return array(
            array('id', 'id'),
            array('guid', 'guid'),
            array('uuid', 'uuid'),
        );
    }

    /**
     * @dataProvider maxAttemptsProvider
     */
    public function testSetAndGetMaxAttempts($maxAttempts)
    {
        $generator = new GuidGenerator;

        $this->assertInstanceOf(GuidGenerator::class, $generator->setMaxAttempts($maxAttempts));

        $this->assertEquals($maxAttempts, $generator->getMaxAttempts());
    }

    public function maxAttemptsProvider()
    {
        return array(
            array(5),
            array(100),
            array(1000),
        );
    }

    /**
     * @expectedException ElectiveGroup\Ucc\Doctrine\GuidGeneratorException
     * @dataProvider invalidMaxAttemptsProvider
     */
    public function testInvalidMaxAttempts($maxAttempts)
    {
        $generator = new GuidGenerator;

        $this->assertInstanceOf(GuidGenerator::class, $generator->setMaxAttempts($maxAttempts));
    }

    public function invalidMaxAttemptsProvider()
    {
        return array(
            array(array()),
            array(new \StdClass),
            array("abc"),
            array(null),
        );
    }

    public function testGenerate()
    {
        $generator = new GuidGenerator;

        //$entity = new IdEntity;
        print_r(get_declared_classes());
die;
        // Create a stub
        $stub = $this->createMock('\Doctrine\ORM\EntityManager');

        // Configure the stub.
        $stub->method('getClassMetadata')
             ->will($this->returnValue($entity));

        var_dump($generator->generate($stub, new \StdClass));
    }
}
