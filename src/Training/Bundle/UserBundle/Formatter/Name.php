<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     trainings
 * @copyright   Copyright (c) Diglin (https://www.diglin.com)
 */

namespace Training\UserBundle\Formatter;

use Oro\Bundle\LocaleBundle\Formatter\NameFormatter;

class Name extends NameFormatter
{
    /**
     * @param null $locale
     *
     * @return string
     */
    public function getNameFormat($locale = null)
    {
        return '%last_name% %first_name% %middle_name%';
    }
}