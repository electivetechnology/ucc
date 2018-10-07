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

    /**
     * @dataProvider lengthProvider
     */
    public function testGenerate($length)
    {
        $generator = new GuidGenerator;

        // Entity
        $entity = new IdEntity;

        // Create a stub
        $stub = $this->createMock('\Doctrine\ORM\EntityManager');

        // Configure the stub.
        $stub->method('getClassMetadata')
             ->will($this->returnValue($entity));
        $stub->method('getRepository')
            ->will($this->returnValue($entity));

        $ret = $generator->generate($stub, $entity, $length);

        $this->assertTrue(is_string($ret));
        $this->assertEquals($length, strlen($ret));
    }

    public function lengthProvider()
    {
        return array(
            [GuidGenerator::DEFAULT_ID_LENGTH],
            [5],
            [20],
            [40],
        );
    }

    /**
     * @dataProvider generateWithCustomIdProvider
     */
    public function testGenerateWithCustomId($id, $length)
    {
        $generator = new GuidGenerator($id, $length);

        // Entity
        $entity = new IdEntity;

        // Create a stub
        $stub = $this->createMock('\Doctrine\ORM\EntityManager');

        // Configure the stub.
        $stub->method('getClassMetadata')
             ->will($this->returnValue($entity));
        $stub->method('getRepository')
            ->will($this->returnValue($entity));

        $ret = $generator->generate($stub, $entity, $length);

        $this->assertTrue(is_string($ret));
        $this->assertEquals($length, strlen($ret));
    }

    public function generateWithCustomIdProvider()
    {
        return array(
            array('guid', 4),
            array('id', 17),
        );
    }

    /**
     * @dataProvider generateWithCustomInvalidIdProvider
     * @expectedException     ElectiveGroup\Ucc\Doctrine\GuidGeneratorException
     */
    public function testGenerateWithInvalidCustomId($id, $length)
    {
        $generator = new GuidGenerator($id, $length);

        // Entity
        $entity = new IdEntity;

        // Create a stub
        $stub = $this->createMock('\Doctrine\ORM\EntityManager');

        // Configure the stub.
        $stub->method('getClassMetadata')
             ->will($this->returnValue($entity));
        $stub->method('getRepository')
            ->will($this->returnValue($entity));

        $ret = $generator->generate($stub, $entity, $length);

        $this->assertTrue(is_string($ret));
        $this->assertEquals($length, strlen($ret));
    }

    public function generateWithCustomInvalidIdProvider()
    {
        return array(
            array('uuid', 4),
            array('myId', 17),
        );
    }

    /**
     * @expectedException     ElectiveGroup\Ucc\Doctrine\GuidGeneratorException
     * @expectedExceptionMessage RandomIdGenerator worked very hard, but failed to generate unique ID
     */
    public function testGenerateFail()
    {
        $generator = new GuidGenerator;

        // Entity
        $entity = new IdEntity;

        // Create a repository
        $repository = new RepositoryStub;

        // Create a em
        $em = $this->createMock('\Doctrine\ORM\EntityManager');
        $em->method('getClassMetadata')
             ->will($this->returnValue($entity));
        $em->method('getRepository')
             ->will($this->returnValue($repository));

        $ret = $generator->generate($em, $entity);
    }
}

class IdEntity
{
    private $id;

    private $guid;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    public function findOneById()
    {
        return;
    }

    public function findOneByGuid()
    {
        return;
    }
}

class RepositoryStub
{
    public function findOneById()
    {
        return true;
    }
}
