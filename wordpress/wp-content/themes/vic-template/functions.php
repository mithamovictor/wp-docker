<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

require_once('inc/comments-walker.php');

function register_theme_styles() {
  wp_enqueue_style('styles', get_stylesheet_directory_uri().'/style.css', [], '1.0.0', 'all');
  wp_enqueue_style('tailwindcss', get_stylesheet_directory_uri().'/dist/css/tailwind.min.css', [], '1.0.0', 'all');
  wp_enqueue_style('stylesheet', get_stylesheet_directory_uri().'/dist/css/app.css', [], '1.0.0', 'all');
  wp_enqueue_script('scripts', get_stylesheet_directory_uri().'/dist/js/app.js', [], '1.0.0', false);
}

add_action('wp_enqueue_scripts', 'register_theme_styles');

function register_custom_nav_menus() {
  register_nav_menus(
    [
      'desktop_menu' => __('Desktop Menu', 'theme'),
      'footer_menu'  => __('Footer Menu', 'theme')
    ]
  );
}

add_action('init', 'register_custom_nav_menus');

function theme_theme_support() {
  if(function_exists('add_theme_support')):
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('post_thumbnails');
    add_theme_support(
      'post-formats',
      [ 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ]
    );
    add_theme_support(
      'html5',
      [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ]
    );
    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');
    // Add support for Block Styles.
    add_theme_support('wp-block-styles');
    // Add support for full and wide align images.
    add_theme_support('align-wide');
    // Add support for editor styles.
    add_theme_support('editor-styles');
    // Enqueue editor styles.
    add_editor_style('style-editor.css');
    // Add custom editor font sizes.
    add_theme_support(
      'editor-font-sizes',
      [
        [
          'name'      => __('Small', 'theme'),
          'shortName' => __('S', 'theme'),
          'size'      => 19.5,
          'slug'      => 'small'
        ],
        [
          'name'      => __('Normal', 'theme'),
          'shortName' => __('M', 'theme'),
          'size'      => 22,
          'slug'      => 'normal'
        ],
        [
          'name'      => __('Large', 'theme'),
          'shortName' => __('L', 'theme'),
          'size'      => 36.5,
          'slug'      => 'large'
        ],
        [
          'name'      => __('Huge', 'theme'),
          'shortName' => __('XL', 'theme'),
          'size'      => 49.5,
          'slug'      => 'huge'
        ]
      ]
    );
    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');
  endif;
}

add_action('after_setup_theme', 'theme_theme_support');

function register_custom_sidebar() {
  register_sidebar(
    [
      'name'          => esc_html__('Sidebar', 'theme'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'theme'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ]
  );
  register_sidebar(
    [
      'name'          => esc_html__('Footer Sidebar', 'theme'),
      'id'            => 'sidebar-2',
      'description'   => esc_html__('Add widgets here.', 'theme'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h4 class="widget-title">',
      'after_title'   => '</h4>',
    ]
  );
}

add_action('widgets_init', 'register_custom_sidebar');
