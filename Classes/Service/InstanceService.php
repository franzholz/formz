<?php
/*
 * 2017 Romain CANON <romain.hydrocanon@gmail.com>
 *
 * This file is part of the TYPO3 FormZ project.
 * It is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License, either
 * version 3 of the License, or any later version.
 *
 * For the full copyright and license information, see:
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Romm\Formz\Service;

use Romm\Formz\Core\Core;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class InstanceService implements SingletonInterface
{
    /**
     * @var InstanceService
     */
    private static $instance;

    /**
     * @var array
     */
    protected $objectInstances = [];

    /**
     * @return InstanceService
     */
    public static function get()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param string $className
     * @param bool   $useObjectManager
     * @return object
     */
    public function getInstance($className, $useObjectManager = false)
    {
        if (null === $this->objectInstances[$className]) {
            $this->objectInstances[$className] = $useObjectManager
                ? Core::instantiate($className)
                : GeneralUtility::makeInstance($className);
        }
        return $this->objectInstances[$className];
    }

    /**
     * Used in unit tests.
     */
    public function reset()
    {
        foreach (array_keys($this->objectInstances) as $className) {
            if ($className !== self::class) {
                unset($this->objectInstances[$className]);
            }
        }
    }

    /**
     * Used in unit tests.
     *
     * @param string $className
     * @param object $instance
     */
    public function forceInstance($className, $instance)
    {
        $this->objectInstances[$className] = $instance;
    }
}
