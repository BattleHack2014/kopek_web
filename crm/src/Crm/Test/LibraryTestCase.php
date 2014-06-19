<?php
namespace Crm\Test;

use \Crm\Logic\Logic;

/**
 * Базовый класс для тестирования "Рекламной платформы" как библиотеки
 */
class LibraryTestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp() {
        if (!defined('ENV'))
            define('ENV', 'dev');
    }

    protected function callPrivate($object, $method, $args = array()) {
        $method = new \ReflectionMethod(
            get_class($object), $method
        );
        $method->setAccessible(TRUE);

        return $method->invokeArgs($object, $args);
    }

    protected function setPrivateProperty($object, $property_name, $value) {
        $property = new \ReflectionProperty(
            get_class($object), $property_name
        );
        $property->setAccessible(TRUE);
        $property->setValue($object, $value);
        return $object;
    }

    protected function getPrivateProperty($object, $property_name) {
        $property = new \ReflectionProperty(
            get_class($object), $property_name
        );
        $property->setAccessible(TRUE);
        return $property->getValue($object);
    }

    protected function assertCorrectOutputFormat($content) {
        $this->assertTrue(is_array($content));
        $this->assertArrayHasKey(Logic::OUTPUT_STATUS, $content);

        if ($content[Logic::OUTPUT_STATUS]) {
            $this->assertArrayHasKey(Logic::OUTPUT_RESULT, $content);
            $this->assertArrayHasKey(Logic::OUTPUT_MESSAGE, $content);
            return;
        }

        $this->assertArrayHasKey(Logic::OUTPUT_ERROR, $content);
    }

    protected function addTestComment($id) {
        Logic::getDbWriter()->executeQuery(
            "INSERT IGNORE INTO `promo_campaign_user_feedback` (
                `id`,
                `object_id`,
                `feedback_type_id`,
                `parent_id`,
                `imhonet_user_id`,
                `user_key`,
                `value_text`,
                `created_at`
            )
            VALUES (
                " . $id . ",
                '1',
                '1',
                '0',
                NULL,
                'key',
                'Comment for unit-test',
                CURRENT_TIMESTAMP
            );"
        );
    }
}