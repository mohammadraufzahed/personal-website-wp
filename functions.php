<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/StarterSite.php';

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new StarterSite();

function enqueue_scripts() {
	$scripts = [
		'main_script' => '/dist/main.mjs'
	];

	foreach ( $scripts as $name => $script ) {
		try {
			wp_enqueue_script( $name, get_template_directory_uri() . $script, [], filectime( get_template_directory() . $script ) ?? 1 );
		} catch ( \Exception $e ) {
			error_log( $e->getMessage() );
		}
	}
}

function enqueue_styles() {
	$styles = [
		'main_styles' => '/dist/style.css',
	];

	foreach ( $styles as $name => $style ) {
		try {
			wp_enqueue_style( $name, get_template_directory_uri() . $style, [], filectime( get_template_directory() . $style ) ?? 1 );
		} catch ( \Exception $e ) {
			error_log( $e->getMessage() );
		}
	}

}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );