<?php
function add_theme_scripts() {
  wp_deregister_script('jquery');
  wp_register_script( 'jquery', ("https://code.jquery.com/jquery-2.2.3.min.js"));
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_script( 'jquery' );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function aquatic_theme_init() {

  register_setting( 'aquatic-settings-group', 'aquatic_settings' );

  add_settings_section(
    'aquatic_theme_section',
    'Aquatic Theme Basic Settings',
    'aquatic_theme_section_callback',
    'aquaticsettings'
  );

  add_settings_field(
    'aquatic_body_text',
    'Homepage text',
    'aquatic_body_text_callback',
    'aquaticsettings',
    'aquatic_theme_section'
  );

  add_settings_field(
    'aquatic_twitter_link',
    'Twitter profile link',
    'aquatic_twitter_link_callback',
    'aquaticsettings',
    'aquatic_theme_section'
  );

  add_settings_field(
    'aquatic_youtube_link',
    'Youtube profile link',
    'aquatic_youtube_link_callback',
    'aquaticsettings',
    'aquatic_theme_section'
  );

  add_settings_field(
    'aquatic_github_link',
    'Github profile link',
    'aquatic_github_link_callback',
    'aquaticsettings',
    'aquatic_theme_section'
  );

}
add_action( 'admin_init', 'aquatic_theme_init' );

function aquatic_theme_section_callback() {

}

function aquatic_body_text_callback() {
  $options = get_option( 'aquatic_settings' );
  if( !isset( $options['body_text'] ) ) $options['body_text'] = 'text';

  echo '<textarea cols="100" name="aquatic_settings[body_text]">' . $options['body_text'] . '</textarea>';}

function aquatic_twitter_link_callback() {
  $options = get_option( 'aquatic_settings' );
  if( !isset( $options['twitter_link'] ) ) $options['twitter_link'] = 'Not set';

  echo '<input type="text" name="aquatic_settings[twitter_link]" value="' . $options['twitter_link'] . '" placeholder="Twitter profile link">';
}

function aquatic_youtube_link_callback() {
  $options = get_option( 'aquatic_settings' );
  if( !isset( $options['youtube_link'] ) ) $options['youtube_link'] = 'Not set';

  echo '<input type="text" name="aquatic_settings[youtube_link]" value="' . $options['youtube_link'] . '" placeholder="Youtube profile link">';
}

function aquatic_github_link_callback() {
  $options = get_option( 'aquatic_settings' );
  if( !isset( $options['github_link'] ) ) $options['github_link'] = 'Not set';

  echo '<input type="text" name="aquatic_settings[github_link]" value="' . $options['github_link'] . '" placeholder="Github profile link">';
}

// Theme options page
function aquatic_add_theme_page() {

	add_theme_page(
		__('Theme Options', 'wpsettings'),
		__('Theme Options', 'wpsettings'),
		'edit_theme_options',
		'aquaticsettings',
		'aquatic_theme_options_page'
	);

}
add_action('admin_menu', 'aquatic_add_theme_page');

function aquatic_theme_options_page() {
?>
<div class="wrap">

	<h2>Theme Options - <?php echo wp_get_theme(); ?></h2>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'aquatic-settings-group' );
		do_settings_sections( 'aquaticsettings' );
		submit_button();
	?>

</div>

<?php
}
