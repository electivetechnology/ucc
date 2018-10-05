<?php

namespace ElectiveGroup\Ucc\Tests\Doctrine;

/**
 * ElectiveGroup\Ucc\Tests\Doctrine\IdEntity
 *
 * @author Kris Rybak <kris@electivegroup.com>
 */
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
}
