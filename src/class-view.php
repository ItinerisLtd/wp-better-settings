<?php
/**
 * WP Better Settings
 *
 * A simplified OOP implementation of the WP Settings API.
 *
 * @package   WP_Better_Settings
 * @author    Typist Tech <wp-better-settings@typist.tech>
 * @copyright 2017 Typist Tech
 * @license   GPL-2.0+
 * @see       https://www.typist.tech/projects/wp-better-settings
 * @see       https://github.com/TypistTech/wp-better-settings
 */

namespace WP_Better_Settings;

/**
 * Class View.
 *
 * Accepts a filename of a PHP file and renders its content on request.
 *
 * @since 0.1.0
 */
class View implements View_Interface {
	/**
	 * Array of allowed tags to let through escaping.
	 *
	 * @since  0.1.0
	 * @access private
	 * @var array
	 */
	private $allowed_tags;

	/**
	 * Filename of the PHP view to render.
	 *
	 * @since  0.1.0
	 * @access private
	 * @var string
	 */
	private $filename;

	/**
	 * View constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param string $filename      Filename of the PHP view to render.
	 * @param array  $allowed_tags  [Optional] Array of allowed tags to
	 *                              let through escaping functions. Set
	 *                              to sane defaults if none provided.
	 */
	public function __construct( string $filename, array $allowed_tags = [] ) {
		$this->filename     = $filename;
		$this->allowed_tags = empty( $allowed_tags )
			? $this->default_allowed_tags()
			: $allowed_tags;
	}

	/**
	 * Prepare an array of allowed tags by adding form elements to the existing
	 * array.
	 *
	 * This makes sure that the basic form elements always pass through the
	 * escaping functions.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return array Modified tags array.
	 */
	private function default_allowed_tags() : array {
		$form_tags = [
			'form'     => [
				'id'     => true,
				'class'  => true,
				'action' => true,
				'method' => true,
			],
			'input'    => [
				'id'               => true,
				'class'            => true,
				'type'             => true,
				'name'             => true,
				'value'            => true,
				'checked'          => true,
				'disabled'         => true,
				'aria-describedby' => true,
			],
			'textarea' => [
				'aria-describedby' => true,
				'col'              => true,
				'disabled'         => true,
				'row'              => true,
			],
		];

		return array_replace_recursive( wp_kses_allowed_html( 'post' ), $form_tags );
	}

	/**
	 * Echo a given view safely.
	 *
	 * @since 0.2.0
	 *
	 * @param mixed $context Context ArrayObject for which to render the view.
	 *
	 * @return void
	 */
	public function echo_kses( $context ) {
		echo wp_kses(
			$this->render( $context ),
			$this->allowed_tags
		);
	}

	/**
	 * Render the associated view as string.
	 *
	 * @see    https://github.com/Medium/medium-wordpress-plugin/blob/c31713968990bab5d83db68cf486953ea161a009/lib/medium-view.php
	 * @since  0.1.0
	 *
	 * @param mixed $context Context object to be passed into view partial.
	 *
	 * @return string HTML string.
	 */
	public function render( $context ) : string {
		if ( ! is_readable( $this->filename ) ) {
			return '';
		}

		ob_start();
		include $this->filename;

		return ob_get_clean();
	}
}
