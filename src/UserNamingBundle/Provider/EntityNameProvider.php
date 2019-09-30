<?php

namespace App\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;

class EntityNameProvider implements EntityNameProviderInterface
{
    public function getName($format, $locale, $entity)
    {
        if ($format === self::FULL && $this->isFormatSupported(get_class($entity))) {
            return strtr(
                '%lastname% %firstname% %middlename%',
                [
                    '%lastname%' => $entity->getLastName(),
                    '%firstname%' => $entity->getFirstName(),
                    '%middlename%' => $entity->getMiddleName(),
                ]
            );
        }

        return false;
    }

    public function getNameDQL($format, $locale, $className, $alias)
    {
        if ($format !== self::FULL || !$this->isFormatSupported($className)) {
            return false;
        }

        return strtr(
            "(%alias%.lastName% || ' ' || %alias%.firstName || ' ' || %alias%.middleName)",
            [
                '%alias%' => $alias,
            ]
        );
    }

    /**
     * @param string $className
     *
     * @return bool
     */
    protected function isFormatSupported($className)
    {
        if (!is_a($className, 'Oro\Bundle\LocaleBundle\Model\FirstNameInterface', true)) {
            return false;
        }
        if (!is_a($className, 'Oro\Bundle\LocaleBundle\Model\LastNameInterface', true)) {
            return false;
        }
        if (!is_a($className, 'Oro\Bundle\LocaleBundle\Model\MiddleNameInterface', true)) {
            return false;
        }

        return true;
    }
}
