<?php
/**
 * Register Social Links List
 *
 * @package    Powerkit
 * @subpackage Modules/Helper
 */

/**
 * Set list social
 *
 * @param array $list Array social params.
 * @return array Array social params.
 */
function powerkit_social_links_list( $list = array() ) {

	// Facebook.
	$list['facebook'] = array(
		'id'     => 'facebook',
		'name'   => esc_html__( 'Facebook', 'powerkit' ),
		'label'  => esc_html__( 'Likes', 'powerkit' ),
		'link'   => esc_url( 'https://facebook.com/%powerkit_social_links_facebook_user%' ),
		'fields' => array(
			'powerkit_social_links_facebook_user' => esc_html__( 'Facebook User', 'powerkit' ),
		),
	);

	// Twitter.
	$list['twitter'] = array(
		'id'     => 'twitter',
		'name'   => esc_html__( 'Twitter', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://twitter.com/%powerkit_social_links_twitter_user%' ),
		'fields' => array(
			'powerkit_social_links_twitter_user' => esc_html__( 'Twitter User', 'powerkit' ),
		),
	);

	// Instagram.
	$list['instagram'] = array(
		'id'     => 'instagram',
		'name'   => esc_html__( 'Instagram', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://www.instagram.com/%powerkit_social_links_instagram_user%' ),
		'fields' => array(
			'powerkit_social_links_instagram_user' => esc_html__( 'Instagram User', 'powerkit' ),
		),
	);

	// Pinterest.
	$list['pinterest'] = array(
		'id'     => 'pinterest',
		'name'   => esc_html__( 'Pinterest', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://pinterest.com/%powerkit_social_links_pinterest_user%' ),
		'fields' => array(
			'powerkit_social_links_pinterest_user' => esc_html__( 'Pinterest User', 'powerkit' ),
		),
	);

	// Google Plus.
	$list['google-plus'] = array(
		'id'     => 'google-plus',
		'name'   => esc_html__( 'Google Plus', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://plus.google.com/u/0/%powerkit_social_links_google_plus_id%' ),
		'fields' => array(
			'powerkit_social_links_google_plus_id' => esc_html__( 'Google Plus ID', 'powerkit' ),
		),
	);

	// YouTube.
	$list['youtube'] = array(
		'id'     => 'youtube',
		'name'   => esc_html__( 'YouTube', 'powerkit' ),
		'label'  => esc_html__( 'Subscribers', 'powerkit' ),
		'link'   => array(
			'powerkit_social_links_youtube_channel_type' => array(
				'user'    => esc_url( 'https://www.youtube.com/user/%powerkit_social_links_youtube_slug%' ),
				'channel' => esc_url( 'https://www.youtube.com/channel/%powerkit_social_links_youtube_slug%' ),
			),
		),
		'fields' => array(
			'powerkit_social_links_youtube_channel_type' => array(
				'title'   => esc_html__( 'YouTube Channel Type', 'powerkit' ),
				'options' => array(
					'user'    => esc_html__( 'User', 'powerkit' ),
					'channel' => esc_html__( 'Channel', 'powerkit' ),
				),
			),
			'powerkit_social_links_youtube_slug'  => esc_html__( 'YouTube User or Channel ID', 'powerkit' ),
		),
	);

	// Telegram.
	$list['telegram'] = array(
		'id'     => 'telegram',
		'name'   => esc_html__( 'Telegram', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => 'https://t.me/%powerkit_social_links_telegram_chat%',
		'fields' => array(
			'powerkit_social_links_telegram_chat' => esc_html__( 'Telegram Channel ID', 'powerkit' ),
		),
	);

	// Vimeo.
	$list['vimeo'] = array(
		'id'     => 'vimeo',
		'name'   => esc_html__( 'Vimeo', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://vimeo.com/%powerkit_social_links_vimeo_user%' ),
		'fields' => array(
			'powerkit_social_links_vimeo_user' => esc_html__( 'Vimeo User ID', 'powerkit' ),
		),
	);

	// SoundCloud.
	$list['soundcloud'] = array(
		'id'     => 'soundcloud',
		'name'   => esc_html__( 'SoundCloud', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://soundcloud.com/%powerkit_social_links_soundcloud_user_id%' ),
		'fields' => array(
			'powerkit_social_links_soundcloud_user_id' => esc_html__( 'SoundCloud User ID', 'powerkit' ),
		),
	);

	// Spotify.
	$list['spotify'] = array(
		'id'     => 'spotify',
		'name'   => esc_html__( 'Spotify', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => array(
			'powerkit_social_links_spotify_type' => array(
				'user'   => esc_url( 'https://open.spotify.com/user/%powerkit_social_links_spotify_user%' ),
				'show'   => esc_url( 'https://open.spotify.com/show/%powerkit_social_links_spotify_user%' ),
				'artist' => esc_url( 'https://open.spotify.com/artist/%powerkit_social_links_spotify_user%' ),
			),
		),
		'fields' => array(
			'powerkit_social_links_spotify_type' => array(
				'title'   => esc_html__( 'Spotify Type', 'powerkit' ),
				'options' => array(
					'user'   => esc_html__( 'User', 'powerkit' ),
					'show'   => esc_html__( 'Show', 'powerkit' ),
					'artist' => esc_html__( 'Artist', 'powerkit' ),
				),
			),
			'powerkit_social_links_spotify_user' => esc_html__( 'Spotify User or Show ID', 'powerkit' ),
		),
	);

	// Dribbble.
	$list['dribbble'] = array(
		'id'     => 'dribbble',
		'name'   => esc_html__( 'Dribbble', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://dribbble.com/%powerkit_social_links_dribbble_user%' ),
		'fields' => array(
			'powerkit_social_links_dribbble_user' => esc_html__( 'Dribbble User ID', 'powerkit' ),
		),
	);

	// Behance.
	$list['behance'] = array(
		'id'     => 'behance',
		'name'   => esc_html__( 'Behance', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://www.behance.net/%powerkit_social_links_behance_user%' ),
		'fields' => array(
			'powerkit_social_links_behance_user' => esc_html__( 'Behance User ID', 'powerkit' ),
		),
	);

	// GitHub.
	$list['github'] = array(
		'id'     => 'github',
		'name'   => esc_html__( 'GitHub', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://github.com/%powerkit_social_links_github_user%' ),
		'fields' => array(
			'powerkit_social_links_github_user' => esc_html__( 'GitHub User ID', 'powerkit' ),
		),
	);

	// VK.
	$list['vk'] = array(
		'id'     => 'vk',
		'name'   => esc_html__( 'VK', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => esc_url( 'https://vk.com/%powerkit_social_links_vk_id%' ),
		'fields' => array(
			'powerkit_social_links_vk_id' => esc_html__( 'Page ID', 'powerkit' ),
		),
	);

	// LinkedIn.
	$list['linkedin'] = array(
		'id'     => 'linkedin',
		'name'   => esc_html__( 'LinkedIn', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => array(
			'powerkit_social_links_linkedin_channel_type' => array(
				'personal' => esc_url( 'https://www.linkedin.com/in/%powerkit_social_links_linkedin_slug%' ),
				'business' => esc_url( 'https://www.linkedin.com/company/%powerkit_social_links_linkedin_slug%' ),
			),
		),
		'fields' => array(
			'powerkit_social_links_linkedin_channel_type' => array(
				'title'   => esc_html__( 'Profile Type', 'powerkit' ),
				'options' => array(
					'personal' => esc_html__( 'Personal', 'powerkit' ),
					'business' => esc_html__( 'Business', 'powerkit' ),
				),
			),
			'powerkit_social_links_linkedin_slug'         => esc_html__( 'LinkedIn Company or User ID', 'powerkit' ),
		),
	);

	// Twitch.
	$list['twitch'] = array(
		'id'     => 'twitch',
		'name'   => esc_html__( 'Twitch', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => 'https://www.twitch.tv/%powerkit_social_links_twitch_user_id%',
		'fields' => array(
			'powerkit_social_links_twitch_user_id' => esc_html__( 'Twitch Channel ID', 'powerkit' ),
		),
	);


	// Flickr.
	$list['flickr'] = array(
		'id'     => 'flickr',
		'name'   => esc_html__( 'Flickr', 'powerkit' ),
		'label'  => esc_html__( 'Follow', 'powerkit' ),
		'link'   => 'https://www.flickr.com/photos/%powerkit_social_links_flickr_user_id%',
		'fields' => array(
			'powerkit_social_links_flickr_user_id' => esc_html__( 'User ID', 'powerkit' ),
		),
	);

	// Snapchat.
	$list['snapchat'] = array(
		'id'     => 'snapchat',
		'name'   => esc_html__( 'Snapchat', 'powerkit' ),
		'label'  => esc_html__( 'Follow', 'powerkit' ),
		'link'   => 'https://www.snapchat.com/add/%powerkit_social_links_snapchat_user%',
		'fields' => array(
			'powerkit_social_links_snapchat_user' => esc_html__( 'Account Name', 'powerkit' ),
		),
	);

	// Medium.
	$list['medium'] = array(
		'id'     => 'medium',
		'name'   => esc_html__( 'Medium', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => 'https://medium.com/%powerkit_social_links_medium_user%',
		'fields' => array(
			'powerkit_social_links_medium_user' => esc_html__( 'Medium Username', 'powerkit' ) . '<p class="description">Example: @user_name</p>',
		),
	);

	// Tumblr.
	$list['tumblr'] = array(
		'id'     => 'tumblr',
		'name'   => esc_html__( 'Tumblr', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => '%powerkit_social_links_tumblr_url%',
		'fields' => array(
			'powerkit_social_links_tumblr_url' => esc_html__( 'Tumblr URL', 'powerkit' ),
		),
	);

	// Reddit.
	$list['reddit'] = array(
		'id'     => 'reddit',
		'name'   => esc_html__( 'Reddit', 'powerkit' ),
		'label'  => esc_html__( 'Subscribers', 'powerkit' ),
		'link'   => array(
			'powerkit_social_links_reddit_type' => array(
				'subreddit' => esc_url( 'https://www.reddit.com/r/%powerkit_social_links_reddit_user%' ),
				'user'      => esc_url( 'https://www.reddit.com/user/%powerkit_social_links_reddit_user%' ),
			),
		),
		'fields' => array(
			'powerkit_social_links_reddit_type' => array(
				'title'   => esc_html__( 'Type', 'powerkit' ),
				'options' => array(
					'subreddit' => esc_html__( 'Subreddit', 'powerkit' ),
					'user'      => esc_html__( 'User', 'powerkit' ),
				),
			),
			'powerkit_social_links_reddit_user' => esc_html__( 'Subreddit Name or Reddit User ', 'powerkit' ),
		),
	);

	// Bloglovin.
	$list['bloglovin'] = array(
		'id'     => 'bloglovin',
		'name'   => esc_html__( 'Bloglovin', 'powerkit' ),
		'label'  => esc_html__( 'Followers', 'powerkit' ),
		'link'   => '%powerkit_social_links_bloglovin_url%',
		'fields' => array(
			'powerkit_social_links_bloglovin_url' => esc_html__( 'Bloglovin URL', 'powerkit' ),
		),
	);

	// RSS.
	$list['rss'] = array(
		'id'     => 'rss',
		'name'   => esc_html__( 'RSS', 'powerkit' ),
		'label'  => esc_html__( 'Feed', 'powerkit' ),
		'link'   => '%powerkit_social_links_rss_url%',
		'fields' => array(
			'powerkit_social_links_rss_url' => esc_html__( 'RSS URL', 'powerkit' ),
		),
	);

	return $list;
}
add_filter( 'powerkit_social_links_list', 'powerkit_social_links_list' );
