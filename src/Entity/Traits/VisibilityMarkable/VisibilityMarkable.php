<?php

namespace ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable;

use ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable\VisibilityMarkableInterface;
use Doctrine\ORM\Mapping as ORM;
use Ucc\Exception\Data\InvalidDataValueException;

/**
 * ElectiveGroup\Ucc\Entity\Traits\VisibilityMarkable\VisibilityMarkable
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
trait VisibilityMarkable {
    /**
     * @ORM\Column(name="visibility", type="string", length=16, nullable=true)
     */
    private $visibility;

    /**
     * Set visibility
     *
     * @param   $visibility
     * @return  VisibilityMarkable
     */
    public function setVisibility(?string $visibility = null): ?self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return VisibilityMarkable
     */
    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    /**
     * Get Visibility options
     *
     * @return array
     */
    public static function getVisibilityOptions(): array
    {
        return array(
            VisibilityMarkableInterface::VISIBILITY_PUBLIC,
            VisibilityMarkableInterface::VISIBILITY_PROTECTED,
            VisibilityMarkableInterface::VISIBILITY_PRIVATE,
        );
    }

    /**
     * Checks if value is valid
     *
     * @return string       Returns value
     * @throws InvalidDataValueException             
     */
    public static function checkIsValidVisibility($value, array $requirements = array())
    {
        if (in_array($value, self::getVisibilityOptions())) {
            return $value;
        }

        throw new InvalidDataValueException("value must be on of: " . implode(', ', self::getVisibilityOptions()));
    }

    /**
     * Is public
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        if ($this->getVisibility() === self::VISIBILITY_PUBLIC) {
            return true;
        }

        return false;
    }

    /**
     * Is private
     *
     * @return bool
     */
    public function isPrivate(): bool
    {
        if ($this->getVisibility() === self::VISIBILITY_PRIVATE) {
            return true;
        }

        return false;
    }

    /**
     * Is protected
     *
     * @return bool
     */
    public function isProtected(): bool
    {
        if ($this->getVisibility() === self::VISIBILITY_PROTECTED) {
            return true;
        }

        return false;
    }
}
