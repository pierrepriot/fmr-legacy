<?php

function wp_get_archives_advanced($args = '') {
	global $wpdb, $wp_locale;

	$defaults = array(
		'pivot' => 0,
		'limit' => '',
		'format' => 'html', 
		'before' => '',
		'after' => '', 
		'show_post_count' => false
	);
	$defaults['pivot'] = date('Y');

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( '' != $limit ) {
		$limit = (int) $limit;
		$limit = ' LIMIT '.$limit;
	}

	$arcresults = $wpdb->get_results("SELECT DISTINCT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC");
	$pivot_year = date('Y');
	$current_year= '';
	if ( $arcresults ) {
		$afterafter = $after;
		foreach ( $arcresults as $arcresult ) {
			if ($current_year == '') $current_year = $arcresult->year;
			if ($arcresult->year < $pivot_year) {
				if ($current_year <> $arcresult->year) {
					$url  = get_year_link($arcresult->year);
					$text = sprintf(__('%1$d'), $arcresult->year);
					if ( $show_post_count )
						$after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
					echo get_archives_link($url, $text, $format, $before, $after);
				}
			} else {
				$url  = get_month_link($arcresult->year,	$arcresult->month);
				$text = sprintf(__('%1$s %2$d'), $wp_locale->get_month($arcresult->month), $arcresult->year);
				if ( $show_post_count )
					$after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
				echo get_archives_link($url, $text, $format, $before, $after);				
			}
			$current_year = $arcresult->year;
		}
	}
}

?>