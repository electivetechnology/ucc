<?php

namespace ElectiveGroup\Ucc\Doctrine\Types;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;

/**
 * ElectiveGroup\Ucc\Doctrine\Types\DateTimeMicrosecondsType
 *
 * @author Kris Rybak <kris.rybak@electivegroup.com>
 */
class DateTimeMicrosecondsType extends Type
{
    const TYPENAME = 'microseconddatetime';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        if (isset($fieldDeclaration['version']) && $fieldDeclaration['version'] == true) {
            return 'TIMESTAMP';
        }

        return 'DATETIME(6)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof DateTimeInterface) {
            return $value;
        }

        $val = DateTime::createFromFormat('Y-m-d H:i:s.u', $value);

        if ( ! $val) {
            $val = date_create($value);
        }

        if ( ! $val) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                'Y-m-d H:i:s.u'
            );
        }

        return $val;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s.u');
        }

        throw ConversionException::conversionFailedInvalidType(
            $value,
            $this->getName(),
            ['null', 'DateTime']
        );
    }

    public function getName()
    {
        return self::TYPENAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
