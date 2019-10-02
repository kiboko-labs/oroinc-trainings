<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     trainings
 * @copyright   Copyright (c) Diglin (https://www.diglin.com)
 */

namespace Training\UserBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\LocaleBundle\Entity\Localization;
use Oro\Bundle\LocaleBundle\Provider\EntityNameProvider as OrigEntityNameProvider;
use Oro\Bundle\UserBundle\Entity\User;

class EntityNameProvider implements EntityNameProviderInterface
{
    /**
     * @var \Oro\Bundle\LocaleBundle\Provider\EntityNameProvider
     */
    private $entityNameProvider;

    public function __construct(OrigEntityNameProvider $entityNameProvider)
    {
        $this->entityNameProvider = $entityNameProvider;
    }

    /**
     * Returns a text representation of the given entity.
     *
     * @param string $format                   The representation format, for example full, short, etc.
     * @param string|null|Localization $locale The representation locale.
     * @param object $entity                   The entity object
     *
     * @return string A text representation of an entity or FALSE if this provider cannot return reliable result
     */
    public function getName($format, $locale, $entity)
    {
        if (!$entity instanceof User) {
            return $this->entityNameProvider->getName($format, $locale, $entity);
        }

        return sprintf('%s %s %s', $entity->getLastName(), $entity->getFirstName(), $entity->getMiddleName());
    }

    /**
     * Returns a DQL expression that can be used to get a text representation of the given type of entities.
     *
     * @param string $format                   The representation format, for example full, short, etc.
     * @param string|null|Localization $locale The representation locale.
     * @param string $className                The FQCN of the entity
     * @param string $alias                    The alias in SELECT or JOIN statement
     *
     * @return string A DQL expression or FALSE if this provider cannot return reliable result
     */
    public function getNameDQL($format, $locale, $className, $alias)
    {
        return $this->entityNameProvider->getNameDQL();
    }
}