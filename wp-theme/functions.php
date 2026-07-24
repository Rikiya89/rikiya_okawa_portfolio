<?php

function rikiya_portfolio_assets() {
	wp_enqueue_style(
		'rikiya-portfolio-common',
		get_template_directory_uri() . '/assets/css/common.css',
		[ 'gravity_forms_orbital_theme' ],
		filemtime( get_template_directory() . '/assets/css/common.css' )
	);

	wp_enqueue_script(
		'rikiya-portfolio-app',
		get_template_directory_uri() . '/assets/js/app.js',
		[],
		filemtime( get_template_directory() . '/assets/js/app.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'rikiya_portfolio_assets', 20 );

// Force the Contact Form (ID 1) submit button to read "Submit" in English,
// overriding whatever label is saved in the Gravity Forms admin editor.
function rikiya_portfolio_contact_form_button_text( $button ) {
	return preg_replace( "/value='[^']*'/", "value='Submit'", $button );
}
add_filter( 'gform_submit_button_1', 'rikiya_portfolio_contact_form_button_text' );

