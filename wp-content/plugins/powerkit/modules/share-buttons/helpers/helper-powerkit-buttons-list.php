<?php
/**
 * Share Buttons Accounts List
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Add Facebook provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_facebook( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://www.facebook.com/sharer.php?u=' . $share_url, null, '' );

	/* Add account */
	$accounts['facebook'] = array(
		'share_url'    => $share_url,
		'name'         => esc_html__( 'Facebook', 'powerkit' ),
		'label'        => esc_html__( 'Like', 'powerkit' ),
		'count_walker' => 'powerkit_share_buttons_facebook_counter',
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_facebook', 10, 3 );


/**
 * Add Twitter provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_twitter( $accounts, $share_url, $post_id ) {

	$twitter_text = null;
	$via          = null;

	/* Twitter Text */
	if ( intval( $post_id ) > 0 ) {
		$twitter_text = '&text=' . rawurlencode( get_the_title( $post_id ) );
	}

	/* Twitter Via */
	$username = get_option( 'powerkit_social_links_twitter_user' );

	if ( $username ) {
		$via = '&via=' . $username;
	}

	/* Share url */
	$share_url = esc_url( 'https://twitter.com/share?' . $twitter_text . $via . '&url=' . $share_url, null, '' );

	/* Add account */
	$accounts['twitter'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Twitter', 'powerkit' ),
		'label'     => esc_html__( 'Tweet', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_twitter', 10, 3 );


/**
 * Add Pinterest provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_pinterest( $accounts, $share_url, $post_id ) {

	/* Media */
	$media = '';
	if ( intval( $post_id ) > 0 ) {

		$thumb_url = false;

		// Parse all images.
		$post_content = get_post_field( 'post_content', intval( $post_id ) );

		if ( $post_content ) {
			/*
			 * $post_content = apply_filters( 'the_content', $post_content );
			 * $post_content = str_replace( ']]>', ']]&gt;', $post_content );
			*/
			preg_match_all( '/<img[^>]+>/i', $post_content, $result );

			if ( is_array( $result ) ) {

				$images = array();

				// Parse attributes from finded images.
				foreach ( $result[0] as $img_tag ) {
					preg_match_all( '/(class|src)=("[^"]*")/i', $img_tag, $images[ $img_tag ] );
				}

				if ( is_array( $images ) ) {

					// Post Content images loop.
					foreach ( $images as $image_key => $image ) {

						$temp_src  = false;
						$pin_exist = false;

						// Each attributes per image.
						foreach ( $image[1] as $index => $attr ) {
							if ( 'src' === $attr ) {
								$temp_src = $image[2][ $index ];
							}

							if ( 'class' === $attr && strpos( $image[2][ $index ], 'powerkit-pinterest-cover' ) !== false ) {
								$pin_exist = true;
							}
						}

						// Finded! Break loop and return image url.
						if ( $pin_exist ) {
							$thumb_url = $temp_src;

							break;
						}
					}
				}
			}
		}

		// Show post thumnail, if post content doesn't have pinterest class in images.
		if ( ! $thumb_url ) {
			$thumb_url = get_the_post_thumbnail_url( intval( $post_id ), 'large' );
		}

		if ( $thumb_url ) {
			$media = '&media=' . $thumb_url;
		}
	}

	/* Share url */
	$share_url = esc_url( 'https://pinterest.com/pin/create/bookmarklet/?url=' . $share_url . $media, null, '' );

	/* Add account */
	$accounts['pinterest'] = array(
		'share_url'    => $share_url,
		'name'         => esc_html__( 'Pinterest', 'powerkit' ),
		'label'        => esc_html__( 'Pin it', 'powerkit' ),
		'count_walker' => 'powerkit_share_buttons_pinterest_counter',
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_pinterest', 10, 3 );



/**
 * Add Mail provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_mail( $accounts, $share_url, $post_id ) {

	/* Title */
	if ( intval( $post_id ) > 0 ) {
		$post_title = rawurlencode( get_the_title( $post_id ) );
	} else {
		$post_title = esc_html__( 'Share Link', 'powerkit' );
	}

	/* Share url */
	$share_url = esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_title . '%20' . $share_url, null, '' );

	/* Add account */
	$accounts['mail'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Mail', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_mail', 10, 3 );


/**
 * Add Googleplus provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_google( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://plus.google.com/share?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['googleplus'] = array(
		'share_url'    => $share_url,
		'name'         => esc_html__( 'Google Plus', 'powerkit' ),
		'label'        => esc_html__( '+1', 'powerkit' ),
		'count_walker' => 'powerkit_share_buttons_google_counter',
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_google', 10, 3 );


/**
 * Add LinkedIn provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_linkedin( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url, null, '' );

	/* Add account */
	$accounts['linkedin'] = array(
		'share_url'    => $share_url,
		'name'         => esc_html__( 'LinkedIn', 'powerkit' ),
		'label'        => esc_html__( 'Share', 'powerkit' ),
		'count_walker' => 'powerkit_share_buttons_linkedin_counter',
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_linkedin', 10, 3 );


/**
 * Add StumbleUpon provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_stumbleupon( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://www.stumbleupon.com/submit?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['stumbleupon'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'StumbleUpon', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_stumbleupon', 10, 3 );


/**
 * Add Pocket provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_pocket( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://getpocket.com/save?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['pocket'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Pocket', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_pocket', 10, 3 );


/**
 * Add WhatsApp provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_whatsapp( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'whatsapp://send?text=' . $share_url, null, '' );

	/* Add account */
	$accounts['whatsapp'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'WhatsApp', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_whatsapp', 10, 3 );


/**
 * Add Facebook Messenger provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_fb_messenger( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'fb-messenger://share/?link=' . $share_url, null, '' );

	/* Add account */
	$accounts['fb-messenger'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Facebook Messenger', 'powerkit' ),
		'label'     => esc_html__( 'Like', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_fb_messenger', 10, 3 );


/**
 * Add Viber provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_viber( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'viber://forward?text=' . $share_url, null, '' );

	/* Add account */
	$accounts['viber'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Viber', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_viber', 10, 3 );


/**
 * Add Vkontakte provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_vk( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://vk.com/share.php?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['vkontakte'] = array(
		'share_url'    => $share_url,
		'name'         => esc_html__( 'VK', 'powerkit' ),
		'label'        => esc_html__( 'Like', 'powerkit' ),
		'count_walker' => 'powerkit_share_buttons_vkontakte_counter',
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_vk', 10, 3 );


/**
 * Add Telegram provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_telegram( $accounts, $share_url, $post_id ) {

	/* Text */
	$text = null;
	if ( intval( $post_id ) > 0 ) {
		$text = '&text=' . rawurlencode( get_the_title( $post_id ) );
	}

	/* Share url */
	$share_url = esc_url( 'https://t.me/share/url?' . $text . '&url=' . $share_url, null, '' );

	/* Add account */
	$accounts['telegram'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Telegram', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_telegram', 10, 3 );


/**
 * Add LINE provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_line( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://line.me/R/msg/text/?' . $share_url, null, '' );

	/* Add account */
	$accounts['line'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Line', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_line', 10, 3 );


/**
 * Add Reddit provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function powerkit_share_buttons_add_reddit( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://www.reddit.com/submit?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['reddit'] = array(
		'share_url' => $share_url,
		'name'      => esc_html__( 'Reddit', 'powerkit' ),
		'label'     => esc_html__( 'Share', 'powerkit' ),
	);

	return $accounts;
}
add_filter( 'powerkit_share_buttons_accounts', 'powerkit_share_buttons_add_reddit', 10, 3 );
