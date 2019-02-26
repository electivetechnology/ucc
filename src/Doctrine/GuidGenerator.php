<?php

namespace ElectiveGroup\Ucc\Doctrine;

use ElectiveGroup\Ucc\Doctrine\GuidGeneratorException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Ucc\Crypt\Hash;

/**
 * ElectiveGroup\Ucc\Doctrine\GuidGenerator
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
class GuidGenerator extends AbstractIdGenerator
{
    const DEFAULT_ID_LENGTH     = 12;
    const DEFAULT_INDEX         = 'id';
    const DEFAULT_MAX_ATTEMPTS  = 100;

    private $indexName;

    private $maxAttempts;

    private $length;

    public function __construct($index = self::DEFAULT_INDEX, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS, $length = self::DEFAULT_ID_LENGTH)
    {     
        $this->setIndexName($index);
        $this->setMaxAttempts($maxAttempts);
        $this->setLength($length);
    }

    public function getIndexName()
    {
        return $this->indexName;
    }

    public function setIndexName($indexName)
    {
        $this->indexName = $indexName;

        return $this;
    }

    public function getMaxAttempts()
    {
        return $this->maxAttempts;
    }

    public function setMaxAttempts($maxAttempts)
    {
        if (!is_int($maxAttempts)) {
            throw new GuidGeneratorException('maxAttempts must be an integer. ' . gettype($maxAttempts) . ' given.');
        }

        $this->maxAttempts = $maxAttempts;

        return $this;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    public function generate(EntityManager $em, $entity, $length = self::DEFAULT_ID_LENGTH)
    {
        $this->setLength($length);

        $entityName = get_class($entity);

        // Count number of times generator will try
        $attempt = 0;

        while (true) {
            $id = Hash::generateSalt($this->getLength(), false);

            if (property_exists($entityName, $this->getIndexName())) {
                $methodName = 'findOneBy' . ucfirst($this->getIndexName());
            } else {
                throw new GuidGeneratorException('Could not generate id. Entity ' . $entityName . ' has no property named ' . $this->getIndexName());
            }

            $item = $em->getRepository($entityName)->$methodName($id);

            if (!$item) {
                return $id;
            }

            // Should we stop?
            $attempt++;

            if ($attempt > $this->getMaxAttempts()) {
                throw new GuidGeneratorException('RandomIdGenerator worked very hard, but failed to generate unique ID');
            }  
        }
    }
}
