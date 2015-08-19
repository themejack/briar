<?php
/**
 * Dasboard widgets.
 *
 * @since 1.0
 */
function sj_dashboard_setup() {
	add_meta_box( 'dashboard_slicejack', __( 'Slicejack News', 'briar' ), 'sj_dashboard_widget', 'dashboard', 'side', 'high' );
}
add_action( 'wp_dashboard_setup', 'sj_dashboard_setup' );

/**
 * SliceJack News dashboard widget.
 *
 * @since 1.0
 */
function sj_dashboard_widget() {
	global $slicejack_url;

	$feed = array(
		'type' => '',
		'link' => $slicejack_url,
		'url' => $slicejack_url . '?feed=rss2',
		'title' => __( 'SliceJack Blog', 'briar' ),
		'items' => 5,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
	);

	define( 'DOING_AJAX', true );

	wp_dashboard_cached_rss_widget( 'dashboard_slicejack', 'sj_dashboard_widget_output', $feed );
}

/**
 * Display the SliceJack news feed.
 *
 * @since 1.0
 *
 * @param string $widget_id Widget ID.
 * @param array  $feed     Array of informations about RSS feed.
 */
function sj_dashboard_widget_output( $widget_id, $feed ) {
	global $slicejack_url; ?>
	<div class="rss-widget">
		<div style="display: block; text-align: center; margin: 20px 0 30px 0;">
			<a href="<?php echo esc_url( $slicejack_url ); ?>" target="_blank" style="display: inline-block;">
				<img src="data:image/png;base64,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" />
			</a>
		</div>
		<?php sj_widget_rss_output( $feed['url'], $feed ); ?>
		<div style="display: block; text-align: center; margin-top: 30px;">
			<a href="<?php echo esc_url( $slicejack_url . '/blog/' ); ?>" style="display: inline-block; width: 150px; height: 32px; line-height: 32px; color: #777; border: solid 1px #777; border-radius: 2px; text-align: center; text-decoration: none; font-size: 13px;"><?php _e( 'Read more posts', 'briar' ) ?></a>
		</div>
	</div>
	<?php
}

/**
 * Display the RSS entries in a list.
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function sj_widget_rss_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __( '<strong>RSS Error</strong>: %s', 'briar' ), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0, 'items' => 0 );
	$args = wp_parse_args( $args, $default_args );

	$items = (int) $args['items'];
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$show_summary  = (int) $args['show_summary'];
	$show_author   = (int) $args['show_author'];
	$show_date     = (int) $args['show_date'];

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.', 'briar' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items( 0, $items ) as $item ) {
		$link = $item->get_link();
		while ( stristr( $link, 'http' ) != $link ) {
			$link = substr( $link, 1 );
		}
		$link = esc_url( strip_tags( $link ) );

		$title = esc_html( trim( strip_tags( $item->get_title() ) ) );
		if ( empty( $title ) ) {
			$title = __( 'Untitled', 'briar' );
		}

		$desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
		$desc = esc_attr( wp_trim_words( $desc, 55, ' [&hellip;]' ) );

		$summary = '';
		if ( $show_summary ) {
			$summary = $desc;

			// Change existing [...] to [&hellip;].
			if ( '[...]' == substr( $summary, -5 ) ) {
				$summary = substr( $summary, 0, -5 ) . '[&hellip;]';
			}

			$summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			if ( is_object($author) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		$read_more = '';
		if ( $link != '' )
			$read_more = '<a href="' . $link . '" style="display: inline-block; width: 105px; height: 22px; line-height: 22px; color: #777; border: solid 1px #777; border-radius: 2px; text-align: center; text-decoration: none; margin-top: 10px; font-size: 11px;">' . __( 'Read more', 'briar' ) . '</a>';

		if ( $link == '' ) {
			echo "<li>$title{$date}{$summary}{$author}</li>";
		} elseif ( $show_summary ) {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$summary}{$author}{$read_more}</li>";
		} else {
			echo "<li><a class='rsswidget' href='$link'>$title</a>{$date}{$author}{$read_more}</li>";
		}
	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}