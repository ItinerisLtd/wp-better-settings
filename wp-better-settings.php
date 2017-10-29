<?php
/**
 * WP Better Settings
 *
 * A simplified OOP implementation of the WP Settings API.
 *
 * @package   TypistTech\WPBetterSettings
 *
 * @author    Typist Tech <wp-better-settings@typist.tech>
 * @copyright 2017 Typist Tech
 * @license   GPL-2.0+
 *
 * @see       https://www.typist.tech/projects/wp-better-settings
 * @see       https://github.com/TypistTech/wp-better-settings
 */

/**
 * Plugin Name: WP Better Settings
 * Plugin URI:  https://github.com/TypistTech/wp-better-settings
 * Description: Example Plugin for WP Better Settings
 * Version:     0.14.0
 * Author:      Tang Rufus
 * Author URI:  https://www.typist.tech/
 * Text Domain: wp-better-settings
 * Domain Path: src/languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

declare(strict_types=1);

namespace TypistTech\WPBetterSettings;

// If this file is called directly, abort.
use AdamWathan\Form\FormBuilder;

if (! defined('WPINC')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

const WPBS_DEMO_PAGE_SLUG = 'wpbs-demo';

add_action(
    'admin_init',
    function () {
        $builder = new FormBuilder();

        $field1 = new Field(
            'my_text',
            'My Text',
            $builder->text('my_text')
                    ->addClass('regular-text')
                    ->required()
        );

        $field2 = new Field(
            'my_color',
            'My Color',
            $builder->select('my_color')
                    ->addOption('red', 'Blood')
                    ->addOption('blue', 'Sky')
                    ->addOption('green', 'Grass')
        );

        $field3 = new Field(
            'my_checkbox',
            'My Checkbox',
            $builder->checkbox('my_checkbox')
        );

        $section1 = new Section(
            'my-section-1',
            'My Section One'
        );

        $section1->add($field1, $field2, $field3);

        $section2 = new Section(
            'my-section-2',
            'My Section Two'
        );

        $registrar = new Registrar(WPBS_DEMO_PAGE_SLUG);
        $registrar->add($section1, $section2);

        $registrar->run();
    }
);

add_action(
    'admin_menu',
    function () {
        add_menu_page(
            'WPBS Demo',
            'WP Better Settings Demo',
            'manage_options',
            WPBS_DEMO_PAGE_SLUG,
            function () {
                echo '<div class="wrap">';
                settings_errors();

                echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
                echo '<form action="options.php" method="post">';
                settings_fields(WPBS_DEMO_PAGE_SLUG);
                do_settings_sections(WPBS_DEMO_PAGE_SLUG);
                submit_button();
                echo '</form>';
                echo '</div>';
            }
        );
    }
);
