<?php

namespace ElectiveGroup\Ucc\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Ucc\Crypt\Hash;
use ElectiveGroup\Ucc\Doctrine\GuidGeneratorException;

/**
 * ElectiveGroup\Ucc\Doctrine\GuidGenerator
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
class GuidGenerator
{
    const DEFAULT_ID_LENGTH     = 12;
    const DEFAULT_INDEX         = 'id';
    const DEFAULT_MAX_ATTEMPTS  = 100;

    private $indexName;

    private $maxAttempts;

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
        $this->maxAttempts = $maxAttempts;

        return $this;
    }

    public function __construct()
    {     
        $this->setIndexName(self::DEFAULT_INDEX);
        $this->setMaxAttempts(self::DEFAULT_MAX_ATTEMPTS);
    }

    public function generate(ObjectManager $om, $entity, $length = self::DEFAULT_ID_LENGTH)
    {
        $entityName = $om->getClassMetadata(get_class($entity))->getName();

        // Count number of times generator will try
        $attempt = 0;

        while (true) {
            $id = Hash::generateSalt($length, false);

            if (property_exists($entityName, $this->getIndexName())) {
                $methodName = 'findOneBy' . ucfirst($this->getIndexName());
            }

            // Check whether to use "guid" or "id" as index
            if (property_exists($entityName, 'guid')) {
                $methodName = 'findOneByGuid';
            } else {
                $methodName = 'findOneById';
            }

            $item = $om->getRepository($entityName)->$methodName($id);

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
