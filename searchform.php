<?php
/**
 * Search form.
 *
 * @package Briar
 * @since 1.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
	<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'briar' ) ?></span>
	<input name="s" class="search-form__field form-control" type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'briar' ) ?>" value="<?php echo get_search_query() ?>" />
	<input class="search-form__button fa" type="submit" value="&#xf002" />
</form>
