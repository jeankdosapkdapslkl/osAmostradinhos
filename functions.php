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

function cpt_rota_turistica() {

  $labels = array(
    'name'               => 'Rotas turísticas',
    'singular_name'      => 'Rota turística',
    'menu_name'          => 'Rotas turísticas',
    'name_admin_bar'     => 'Rota turística',
    'add_new'            => 'Adicionar nova',
    'add_new_item'       => 'Adicionar nova rota turística',
    'edit_item'          => 'Editar rota turística',
    'new_item'           => 'Nova rota turística',
    'view_item'          => 'Ver rota turística',
    'search_items'       => 'Buscar rotas turísticas',
    'not_found'          => 'Nenhuma rota encontrada',
    'not_found_in_trash' => 'Nenhuma rota no lixo'
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'has_archive'         => true,
    'rewrite'             => array('slug' => 'rotas-turisticas'),
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-location',
    'supports'            => array('title', 'editor', 'thumbnail', 'excerpt')
  );

  register_post_type('rota-turistica', $args);
}
add_action('init', 'cpt_rota_turistica');

add_action('init', function() {

    $labels = [
        'name'               => 'Experiências',
        'singular_name'      => 'Experiência',
        'menu_name'          => 'Experiências',
        'add_new'            => 'Adicionar nova',
        'add_new_item'       => 'Adicionar nova experiência',
        'edit_item'          => 'Editar experiência',
        'new_item'           => 'Nova experiência',
        'view_item'          => 'Ver experiência',
        'search_items'       => 'Buscar experiências',
        'not_found'          => 'Nenhuma experiência encontrada',
        'not_found_in_trash' => 'Nenhuma experiência encontrada no lixo',
    ];

    register_post_type('experiencias', [
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-star-filled', 
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true, 
        'has_archive' => true,
        'rewrite' => ['slug' => 'experiencias'],
    ]);
});

add_action('add_meta_boxes', function() {
    add_meta_box(
        'icone_experiencia',
        'Ícone da Experiência (Font Awesome)',
        'render_icone_experiencia_field',
        'experiencias',
        'side',
        'default'
    );
});

function render_icone_experiencia_field($post) {
    $value = get_post_meta($post->ID, '_icone_experiencia', true);
    echo '<label for="icone_experiencia">Ex: <strong>fa-solid fa-campground</strong></label><br><br>';
    echo '<input type="text" id="icone_experiencia" name="icone_experiencia" value="' . esc_attr($value) . '" style="width:100%;">';
}

add_action('save_post', function($post_id) {
    if (array_key_exists('icone_experiencia', $_POST)) {
        update_post_meta($post_id, '_icone_experiencia', sanitize_text_field($_POST['icone_experiencia']));
    }
});

function criar_custom_post_hospedagens() {
    $labels = array(
        'name'                  => 'Hospedagens',
        'singular_name'         => 'Hospedagem',
        'menu_name'             => 'Hospedagens',
        'name_admin_bar'        => 'Hospedagem',
        'add_new'               => 'Adicionar Novo',
        'add_new_item'          => 'Adicionar Novo Hospedagem',
        'new_item'              => 'Novo Hospedagem',
        'edit_item'             => 'Editar Hospedagem',
        'view_item'             => 'Ver Hospedagem',
        'all_items'             => 'Todos os Hospedagens',
        'search_items'          => 'Procurar Hospedagens',
        'not_found'             => 'Nenhuma hospedagem encontrado',
        'not_found_in_trash'    => 'Nenhuma hospedagem na lixeira',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true, // visível no site
        'has_archive'           => true, // cria página de arquivo /atrativos
        'rewrite'               => array('slug' => 'hospedagens'),
        'menu_icon'             => 'dashicons-location-alt', // ícone de mapa
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'          => true, // ativa suporte ao editor de blocos (Gutenberg)
    );

    register_post_type('hospedagens', $args);
}
add_action('init', 'criar_custom_post_hospedagens');
function criar_taxonomia_tipo_hospedagem() {

  $labels = array(
      'name'              => 'Tipos de Hospedagem',
      'singular_name'     => 'Tipo de Hospedagem',
      'search_items'      => 'Procurar Tipos de Hospedagem',
      'all_items'         => 'Todos os Tipos',
      'edit_item'         => 'Editar Tipo',
      'update_item'       => 'Atualizar Tipo',
      'add_new_item'      => 'Adicionar Novo Tipo',
      'new_item_name'     => 'Novo Tipo de Hospedagem',
      'menu_name'         => 'Tipos de Hospedagem',
  );

  $args = array(
      'hierarchical'      => true, // funciona como categorias
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array('slug' => 'tipo-hospedagem'),
      'show_in_rest'      => true,
  );

  register_taxonomy('tipo_hospedagem', array('hospedagens'), $args);
}
add_action('init', 'criar_taxonomia_tipo_hospedagem');


?>