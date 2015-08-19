<?php
/**
 * Briar Theme Customizer extra functions
 *
 * @package Briar
 * @since 1.1
 */

function sanitize_text_trim( $value ) {
	if ( empty( $value ) ) return '';
	return trim( $value );
}

function sanitize_social_buttons( $value ) {
	if ( ! is_array( $value ) ) return array();

	return $value;
}

class Sanitize_Select {
	public $keys;
	public $default_value;

	public function Sanitize_Select( $keys, $default_value = '' ) {
		$this->keys = $keys;
		$this->default_value = $default_value;
	}

	/**
	 * Sanitize callback
	 * @param  [string] $value
	 * @return [string]
	 */
	public function callback( $value ) {
		if ( ! in_array( $value, $this->keys ) )
			return $default_value;

		return $value;
	}
}