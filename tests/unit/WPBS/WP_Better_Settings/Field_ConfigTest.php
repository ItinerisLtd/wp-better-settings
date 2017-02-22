<?php
namespace WPBS\WP_Better_Settings;

/**
 * @coversDefaultClass \WPBS\WP_Better_Settings\Field_Config
 */
class Field_ConfigTest extends \Codeception\TestCase\WPTestCase
{
    /**
     * @coversNothing
     */
    public function testIsAnInstanceOfConfig()
    {
        $config = new Field_Config;
        $this->assertInstanceOf(Config::class, $config);
    }

    /**
     * @covers ::__construct
     */
    public function testDefaultSanitizeCallback()
    {
        $config = new Field_Config;
        $this->assertAttributeEquals('sanitize_text_field', 'sanitize_callback', $config);
    }
}
