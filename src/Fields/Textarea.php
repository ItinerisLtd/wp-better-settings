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

namespace TypistTech\WPBetterSettings\Fields;

/**
 * Final class Textarea
 */
class Textarea extends AbstractField
{
    const DEFAULT_VIEW_PARTIAL = 'fields/textarea';

    /**
     * Get rows from extra.
     *
     * @return int
     */
    public function getRows(): int
    {
        return $this->extra['rows'] ?? 0;
    }
}
