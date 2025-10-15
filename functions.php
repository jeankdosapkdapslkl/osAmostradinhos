<?php
function osAmostradinhos_setup() {
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-logo' );
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );

  // ✅ Esta parte é fundamental
  register_nav_menus( array(
    'primary' => __( 'Menu Principal', 'osAmostradinhos-scratch-theme' ),
  ) );
}
add_action( 'after_setup_theme', 'osAmostradinhos_setup' );

function meu_tema_scripts() {
  wp_enqueue_style('meu-tema-style', get_stylesheet_uri());
  wp_enqueue_style('meu-tema-template', get_template_directory_uri() . '/css/template.css', array('meu-tema-style'), '1.0');
}
add_action('wp_enqueue_scripts', 'meu_tema_scripts'); // <- fora da função

?>