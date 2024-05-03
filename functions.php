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
Timber::$dirname = ['templates', 'views'];

new StarterSite();


function enqueue_scripts(): void
{
    $scripts = [
        'main_script' => '/dist/main.mjs'
    ];

    foreach ($scripts as $name => $script) {
        try {
            wp_enqueue_script($name, get_template_directory_uri() . $script, [], filectime(get_template_directory() . $script) ?? 1);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}

function enqueue_styles(): void
{
    $styles = [
        'main_styles' => '/dist/style.css',
    ];

    foreach ($styles as $name => $style) {
        try {
            wp_enqueue_style($name, get_template_directory_uri() . $style, [], filectime(get_template_directory() . $style) ?? 1);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    // Customs
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2', 'all');

}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
add_action('wp_enqueue_scripts', 'enqueue_styles');

function portfolio_custom_post_type(): void
{
    register_post_type(
        'portfolio',
        [
            'labels' => [
                'name' => __('Portfolios'),
                'singular_name' => __('Portfolio'),
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'rewrite' => ['slug' => 'portfolios', 'summery'],
        ]
    );
}

function add_portfolio_fields(): void
{
    add_meta_box('portfolio_description', 'Description', 'portfolio_description', 'portfolio', 'normal', 'default');
}

function portfolio_description($post): void
{
    $description = get_post_meta($post->ID, 'portfolio_description', true);
    ?>
    <label for="portfolio_description">Description:</label>
    <textarea id="portfolio_description" name="portfolio_description" rows="5"
              style="width: 100%"><? echo $description ?></textarea>
    <?php
}

function save_portfolio_fields($post_id): void
{
    if (isset($_POST['portfolio_description'])) {
        update_post_meta($post_id, 'portfolio_description', sanitize_textarea_field($_POST['portfolio_description']));
    }
}

add_action('save_post', 'save_portfolio_fields');
add_action('add_meta_boxes', 'add_portfolio_fields');
add_action('init', 'portfolio_custom_post_type');