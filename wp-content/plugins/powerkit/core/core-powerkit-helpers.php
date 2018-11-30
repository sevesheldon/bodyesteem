<?php
/**
 * The basic helpers functions
 *
 * @package    Powerkit
 * @subpackage Core
 * @version    1.0.0
 * @since      1.0.0
 */

/**
 * Output error message.
 *
 * @param string $message The error message.
 */
function powerkit_alert_warning( $message ) {
	if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
		?>
		<p class="pk-alert pk-alert-warning" role="alert">
			<?php echo wp_kses( $message, 'post' ); ?>
		</p>
		<?php
	}
}

/**
 * Process shortcode atts.
 *
 * @param array $atts Attributes in shortcode tag.
 */
function powerkit_shortcode_atts( $atts ) {
	if ( is_array( $atts ) ) {
		foreach ( $atts as $name => $val ) {
			if ( is_string( $val ) && 'true' === $val ) {
				$atts[ $name ] = true;
			}
			if ( is_string( $val ) && 'false' === $val ) {
				$atts[ $name ] = false;
			}
		}
	}
	return $atts;
}

/**
 * Convert dates to readable format
 *
 * @param string $a Time string (timeformat).
 * @return string Formatted time.
 */
function powerkit_relative_time( $a ) {

	// Get current timestampt.
	$b = strtotime( 'now' );

	// Get timestamp when tweet created.
	$c = strtotime( $a );

	// Get difference.
	$d = $b - $c;

	// Calculate different time values.
	$minute = 60;
	$hour   = $minute * 60;
	$day    = $hour * 24;
	$week   = $day * 7;

	if ( is_numeric( $d ) && $d > 0 ) :

		// If less then 3 seconds.
		if ( $d < 3 ) {
			return esc_html__( 'right now', 'powerkit' );
		}

		// If less then minute.
		if ( $d < $minute ) {
			return floor( $d ) . esc_html__( ' seconds ago', 'powerkit' );
		}

		// If less then 2 minutes.
		if ( $d < $minute * 2 ) {
			return esc_html__( 'about 1 minute ago', 'powerkit' );
		}

		// If less then hour.
		if ( $d < $hour ) {
			return floor( $d / $minute ) . esc_html__( ' minutes ago', 'powerkit' );
		}

		// If less then 2 hours.
		if ( $d < $hour * 2 ) {
			return esc_html__( 'about 1 hour ago', 'powerkit' );
		}

		// If less then day.
		if ( $d < $day ) {
			return floor( $d / $hour ) . esc_html__( ' hours ago', 'powerkit' );
		}

		// If more then day, but less then 2 days.
		if ( $d > $day && $d < $day * 2 ) {
			return esc_html__( 'yesterday', 'powerkit' );
		}

		// If less then year.
		if ( $d < $day * 365 ) {
			return floor( $d / $day ) . esc_html__( ' days ago', 'powerkit' );
		}

		// else return more than a year.
		return esc_html__( 'over a year ago', 'powerkit' );
	endif;
}

/**
 * Truncates string with specified length
 *
 * @param  string $string      Text string.
 * @param  int    $length      Letters length.
 * @param  string $etc         End truncate.
 * @param  bool   $break_words Break words or not.
 * @return string
 */
function powerkit_str_truncate( $string, $length = 80, $etc = '&hellip;', $break_words = false ) {
	if ( 0 === $length ) {
		return '';
	}

	if ( function_exists( 'mb_strlen' ) ) {

		// MultiBite string functions.
		if ( mb_strlen( $string ) > $length ) {
			$length -= min( $length, mb_strlen( $etc ) );
			if ( ! $break_words ) {
				$string = preg_replace( '/\s+?(\S+)?$/', '', mb_substr( $string, 0, $length + 1 ) );
			}

			return mb_substr( $string, 0, $length ) . $etc;
		}
	} else {

		// Default string functions.
		if ( strlen( $string ) > $length ) {
			$length -= min( $length, strlen( $etc ) );
			if ( ! $break_words ) {
				$string = preg_replace( '/\s+?(\S+)?$/', '', substr( $string, 0, $length + 1 ) );
			}

			return substr( $string, 0, $length ) . $etc;
		}
	}

	return $string;
}

/**
 * Set number to Short Form
 *
 * @param int $n       The number.
 * @param int $decimal The decimal.
 */
function powerkit_abridged_number( $n, $decimal = 1 ) {

	// First strip any formatting.
	$n = (float) str_replace( ',', '', $n );

	// Is this a number?
	if ( ! is_numeric( $n ) ) {
		return false;
	}

	// Return current count.
	if ( $n < 1000 ) {
		return number_format_i18n( $n );
	}

	// Add suffix.
	$suffix = array(
		1000000000 => esc_html__( 'B', 'powerkit' ), // Billion.
		1000000    => esc_html__( 'M', 'powerkit' ), // Million.
		1000       => esc_html__( 'K', 'powerkit' ), // Thousand.
	);
	foreach ( $suffix as $k => $v ) {
		if ( $n >= $k ) {
			return number_format_i18n( $n / $k, $decimal ) . $v;
		}
	}
}

/**
 * Time ago
 *
 * @param  string $time The time.
 * @return string
 */
function powerkit_timing_ago( $time ) {
	$periods = array( esc_html__( 'second', 'powerkit' ), esc_html__( 'minute', 'powerkit' ), esc_html__( 'hour', 'powerkit' ), esc_html__( 'day', 'powerkit' ), esc_html__( 'week', 'powerkit' ), esc_html__( 'month', 'powerkit' ), esc_html__( 'year', 'powerkit' ), esc_html__( 'decade', 'powerkit' ) );
	$lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );

	$now = time();

	$difference = $now - $time;
	$tense      = esc_html__( 'ago', 'powerkit' );

	$lengths_count = count( $lengths );

	for ( $j = 0; $difference >= $lengths[ $j ] && $j < $lengths_count - 1; $j++ ) {
		$difference /= $lengths[ $j ];
	}

	$difference = round( $difference );

	if ( 1 !== $difference ) {
		$periods[ $j ] .= 's';
	}

	return "$difference $periods[$j] {$tense} ";
}

/**
 * Encrypt data
 *
 * @param  string $text       The text.
 * @param  string $secret_key The key.
 * @return string
 */
function powerkit_encrypt_data( $text, $secret_key = 'powerkit' ) {

	if ( function_exists( 'openssl_encrypt' ) && function_exists( 'hash' ) ) {
		$encrypt_method = 'AES-256-CBC';

		$key = hash( 'sha256', $secret_key );
		$iv  = substr( hash( 'sha256', 'secret key' ), 0, 16 );

		return base64_encode( openssl_encrypt( $text, $encrypt_method, $key, 0, $iv ) );
	} else {
		return base64_encode( $text );
	}
}

/**
 * Decrypt data
 *
 * @param  string $text       The text.
 * @param  string $secret_key The key.
 * @return string
 */
function powerkit_decrypt_data( $text, $secret_key = 'powerkit' ) {

	if ( function_exists( 'openssl_encrypt' ) && function_exists( 'hash' ) ) {
		$encrypt_method = 'AES-256-CBC';

		$key = hash( 'sha256', $secret_key );
		$iv  = substr( hash( 'sha256', 'secret key' ), 0, 16 );

		return openssl_decrypt( base64_decode( $text ), $encrypt_method, $key, 0, $iv );
	} else {
		return base64_decode( $text );
	}
}

/**
 * Get the user uuid
 *
 * @return string
 */
function powerkit_get_user_uuid() {
	if ( getenv( 'HTTP_CLIENT_IP' ) ) {
		return getenv( 'HTTP_CLIENT_IP' );
	} elseif ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
		return getenv( 'HTTP_X_FORWARDED_FOR' );
	} elseif ( getenv( 'HTTP_X_FORWARDED' ) ) {
		return getenv( 'HTTP_X_FORWARDED' );
	} elseif ( getenv( 'HTTP_FORWARDED_FOR' ) ) {
		return getenv( 'HTTP_FORWARDED_FOR' );
	} elseif ( getenv( 'HTTP_FORWARDED' ) ) {
		return getenv( 'HTTP_FORWARDED' );
	} elseif ( getenv( 'REMOTE_ADDR' ) ) {
		return getenv( 'REMOTE_ADDR' );
	}

	return uniqid( 'x', true );
}

/**
 * Convert by title Cyrillic characters to Latin characters
 *
 * @param string $text The text.
 */
function powerkit_text_with_translit( $text ) {

	$gost = array(
		'А' => 'A', 'Б'  => 'B', 'В'  => 'V', 'Г'  => 'G', 'Ѓ'   => 'G`',
		'Ґ' => 'G`', 'Д' => 'D', 'Е'  => 'E', 'Ё'  => 'YO', 'Є'  => 'YE',
		'Ж' => 'ZH', 'З' => 'Z', 'Ѕ'  => 'Z', 'И'  => 'I', 'Й'   => 'Y',
		'Ј' => 'J', 'І'  => 'I', 'Ї'  => 'YI', 'К' => 'K', 'Ќ'   => 'K',
		'Л' => 'L', 'Љ'  => 'L', 'М'  => 'M', 'Н'  => 'N', 'Њ'   => 'N',
		'О' => 'O', 'П'  => 'P', 'Р'  => 'R', 'С'  => 'S', 'Т'   => 'T',
		'У' => 'U', 'Ў'  => 'U', 'Ф'  => 'F', 'Х'  => 'H', 'Ц'   => 'TS',
		'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '``',
		'Ы' => 'YI', 'Ь' => '`', 'Э'  => 'E`', 'Ю' => 'YU', 'Я'  => 'YA',
		'а' => 'a', 'б'  => 'b', 'в'  => 'v', 'г'  => 'g', 'ѓ'   => 'g',
		'ґ' => 'g', 'д'  => 'd', 'е'  => 'e', 'ё'  => 'yo', 'є'  => 'ye',
		'ж' => 'zh', 'з' => 'z', 'ѕ'  => 'z', 'и'  => 'i', 'й'   => 'y',
		'ј' => 'j', 'і'  => 'i', 'ї'  => 'yi', 'к' => 'k', 'ќ'   => 'k',
		'л' => 'l', 'љ'  => 'l', 'м'  => 'm', 'н'  => 'n', 'њ'   => 'n',
		'о' => 'o', 'п'  => 'p', 'р'  => 'r', 'с'  => 's', 'т'   => 't',
		'у' => 'u', 'ў'  => 'u', 'ф'  => 'f', 'х'  => 'h', 'ц'   => 'ts',
		'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ь' => '',
		'ы' => 'yi', 'ъ' => "'", 'э'  => 'e`', 'ю' => 'yu', 'я'  => 'ya'
	);

	return strtr( $text, $gost );
}

/**
 * Post Date
 *
 * @param bool $compact If compact version shall be displayed.
 */
function powerkit_get_meta_date( $compact = false ) {

	$output = '<span class="meta-date">';

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	if ( false === $compact ) {
		$date = get_the_date();
	} else {
		$date = get_the_date( 'd.m.y' );
	}

	$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), $date, get_the_modified_date( DATE_W3C ), get_the_modified_date() );

	// Wrap the time string in a link, and preface it with 'Posted on'.
	$output .= sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'expertly' ),
		$time_string
	);

	$output .= '</span>';

	return $output;
}

/**
 * Post Author
 *
 * @param bool $compact If compact version shall be displayed.
 */
function powerkit_get_meta_author( $compact = false ) {

	$authors = array( get_the_author_meta( 'ID' ) );

	$output = '<span class="meta-author">';

	$output .= sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		/* translators: %s: author name */
		esc_attr( sprintf( __( 'View all posts by %s', 'expertly' ), get_the_author() ) ),
		// Add author's avatar if compact mode is false.
		( false === $compact ? get_avatar( get_the_author_meta( 'ID' ), 20 ) : '' ) . get_the_author()
	);

	$output .= '</span>';

	return $output;
}

/**
 * Check social links exists.
 */
function powerkit_social_links_exists() {
	if ( ! powerkit_module_enabled( 'social_links' ) ) {
		return;
	}

	if ( get_option( 'powerkit_social_links_multiple_list' ) ) {
		return true;
	}
}

/**
 * Check mailchimp form exists.
 *
 * @param string $id The list ID.
 */
function powerkit_mailchimp_form_exists( $id = 'default' ) {
	if ( ! powerkit_module_enabled( 'opt_in_forms' ) ) {
		return;
	}

	$token = get_option( 'powerkit_mailchimp_token' );

	if ( $token ) {

		if ( ! $id || 'default' === $id ) {
			$id = get_option( 'powerkit_mailchimp_list' );
		}

		if ( $id ) {
			return true;
		}
	}
}

/**
 * Check share buttons exists.
 *
 * @param string $location The location.
 */
function powerkit_share_buttons_exists( $location ) {
	if ( ! powerkit_module_enabled( 'share_buttons' ) ) {
		return;
	}

	if ( ! get_option( "powerkit_share_buttons_{$location}_display" ) ) {
		return;
	}

	$accounts = get_option( "powerkit_share_buttons_{$location}_multiple_list", array( 'facebook', 'twitter', 'pinterest' ) );

	if ( $accounts ) {
		return true;
	}
}
