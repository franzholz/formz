<?php
namespace Romm\Formz\Tests\Unit;

use Romm\ConfigurationObject\Tests\Unit\ConfigurationObjectUnitTestUtility;
use Romm\Formz\Form\FormObject;
use TYPO3\CMS\Core\Tests\UnitTestCase;

abstract class AbstractUnitTest extends UnitTestCase
{

    use ConfigurationObjectUnitTestUtility;
    use FormzUnitTestUtility;

    const FORM_OBJECT_DEFAULT_CLASS_NAME = \stdClass::class;
    const FORM_OBJECT_DEFAULT_NAME = 'foo';

    protected function setUp()
    {
        $this->initializeConfigurationObjectTestServices();
        $this->setUpFormzCore();
    }

    /**
     * @return FormObject
     */
    protected function getFormObject()
    {
        return new FormObject(self::FORM_OBJECT_DEFAULT_CLASS_NAME, self::FORM_OBJECT_DEFAULT_NAME);
    }
}
