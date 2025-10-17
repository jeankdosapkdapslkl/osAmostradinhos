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
add_action('wp_enqueue_scripts', 'meu_tema_scripts');

function criar_custom_post_atrativos() {
    $labels = array(
        'name'                  => 'Atrativos',
        'singular_name'         => 'Atrativo',
        'menu_name'             => 'Atrativos',
        'name_admin_bar'        => 'Atrativo',
        'add_new'               => 'Adicionar Novo',
        'add_new_item'          => 'Adicionar Novo Atrativo',
        'new_item'              => 'Novo Atrativo',
        'edit_item'             => 'Editar Atrativo',
        'view_item'             => 'Ver Atrativo',
        'all_items'             => 'Todos os Atrativos',
        'search_items'          => 'Procurar Atrativos',
        'not_found'             => 'Nenhum atrativo encontrado',
        'not_found_in_trash'    => 'Nenhum atrativo na lixeira',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true, // visível no site
        'has_archive'           => true, // cria página de arquivo /atrativos
        'rewrite'               => array('slug' => 'atrativos'),
        'menu_icon'             => 'dashicons-location-alt', // ícone de mapa
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'          => true, // ativa suporte ao editor de blocos (Gutenberg)
    );

    register_post_type('atrativos', $args);
}
add_action('init', 'criar_custom_post_atrativos');
function criar_taxonomia_tipo_atrativo() {

  $labels = array(
      'name'              => 'Tipos de Atrativo',
      'singular_name'     => 'Tipo de Atrativo',
      'search_items'      => 'Procurar Tipos de Atrativo',
      'all_items'         => 'Todos os Tipos',
      'edit_item'         => 'Editar Tipo',
      'update_item'       => 'Atualizar Tipo',
      'add_new_item'      => 'Adicionar Novo Tipo',
      'new_item_name'     => 'Novo Tipo de Atrativo',
      'menu_name'         => 'Tipos de Atrativo',
  );

  $args = array(
      'hierarchical'      => true, // funciona como categorias
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array('slug' => 'tipo-atrativo'),
      'show_in_rest'      => true,
  );

  register_taxonomy('tipo_atrativo', array('atrativos'), $args);
}
add_action('init', 'criar_taxonomia_tipo_atrativo');



?>