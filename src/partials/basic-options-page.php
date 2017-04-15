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

declare(strict_types=1);

namespace TypistTech\WPBetterSettings;

/* @var MenuPage $context Context passed through from View object. */

$snakecasedMenuSlug = str_replace('-', '_', $context->getMenuSlug());

do_action($snakecasedMenuSlug . '_before_page_title');

echo '<h1>' . esc_html($context->getPageTitle()) . '</h1>';

do_action($snakecasedMenuSlug . '_after_page_title');

include __DIR__ . '/options-form.php';
