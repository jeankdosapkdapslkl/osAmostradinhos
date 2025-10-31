<?php get_header(); ?>

<main class="site-main">
    <section class="hero">
      <div class="overlay">
         <div class="content">
         <h1>VENHA CONHECER RIO DO SUL<br>A CAPITAL DO ALTO VALE</h1>
      <p>Uma cidade acolhedora, cheia de belezas naturais, cultura vibrante e oportunidades únicas para você descobrir.</p>
    </div>
     </div>
    </section>


    <section class="atrativos">
        <h1 class="page-title">Atrativos Turísticos</h1>
    
        <div class="right-left-container">
    
            
            <div class="left">
                <?php
                $args_right = array(
                    'post_type' => 'atrativos',
                    'posts_per_page' => 1,
                    'post_status' => 'publish'
                );
                $query_right = new WP_Query($args_right);
    
                if ($query_right->have_posts()) :
                    while ($query_right->have_posts()) : $query_right->the_post(); ?>
                    <div class="main-post">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                        <?php endif; ?>
                        <div class="main-content">
                            <?php 
                                $tipos = get_the_terms(get_the_ID(), 'tipo_atrativo');
                                if ($tipos && !is_wp_error($tipos)) {
                                    echo '<span class="tipo-atrativo">' . esc_html($tipos[0]->name) . '</span>';
                                }
                            ?>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </div>
                    </div>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 45); ?></p>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
    
            
            <div class="right">
                <?php
                $args_left = array(
                    'post_type' => 'atrativos',
                    'posts_per_page' => 4,
                    'offset' => 1,
                    'post_status' => 'publish'
                );
                $query_left = new WP_Query($args_left);
    
                if ($query_left->have_posts()) :
                    while ($query_left->have_posts()) : $query_left->the_post(); ?>
                    <div class="left-post">
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="thumb">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                        <?php endif; ?>
                        <div class="left-content ">
                            <?php 
                                $tipos = get_the_terms(get_the_ID(), 'tipo_atrativo');
                                if ($tipos && !is_wp_error($tipos)) {
                                    echo '<span class="tipo-atrativo">' . esc_html($tipos[0]->name) . '</span>';
                                }
                            ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                    </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
    
        </div>
    </section>

    <section class="container-rota">
        <div class="rotas">
            <h1 class="page-title">
                Rotas turísticas de
                <p>
                    Rio do Sul
                </p>
            </h1>
    
            <div class="rotas-content">
                 <?php
                    $args_right = array(
                        'post_type' => 'rota-turistica',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    );
                    $query_right = new WP_Query($args_right);
        
                    if ($query_right->have_posts()) :
                        while ($query_right->have_posts()) : $query_right->the_post(); ?>
                        <div class="rota-post">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                                <p><?php the_title(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="thumb">Saiba mais ></a>    
                            <?php endif; ?>
                        </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
            </div>
        </div>
    </section>

    <section class="experiencias">
        <div class="container-experiencias">
            <h2>QUE TIPO DE EXPERIÊNCIA<br>VOCÊ ESTÁ BUSCANDO?</h2>

            <div class="grid">
                <?php
                    $args_right = array(
                        'post_type' => 'experiencias',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    );
                    $query_right = new WP_Query($args_right);
        
                    if ($query_right->have_posts()) :
                        while ($query_right->have_posts()) : $query_right->the_post(); 
                        $icone = get_post_meta(get_the_ID(), '_icone_experiencia', true);
                        ?>
                            <div class="card-container">
                                <span><i class="<?php echo esc_attr($icone); ?>"></i></span>
                                <div class="card">
                                    <p><?php the_title(); ?></p>
                                </div>
                            </div>
                <?php
                        endwhile;
                    wp_reset_postdata();
                    endif;
                ?>
            </div>
        </div>
    </section>

    <section class="hospedagens">
        <h2 class="page-title">Dicas de Hospedagens</h2>
        <?php
            $args_left = array(
                'post_type' => 'hospedagens',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            );
            $query_left = new WP_Query($args_left);

            if ($query_left->have_posts()) :
                while ($query_left->have_posts()) : $query_left->the_post(); ?>
                <div class="item-hospedagem">
                    <div class="thumb">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } ?>
                    </div>
                    <div class="info">
                        <h3><?php the_title(); ?></h3>
                        <?php 
                            $tipos = get_the_terms(get_the_ID(), 'tipo_hospedagem');
                            if ($tipos && !is_wp_error($tipos)) {
                                echo '<span class="categoria">' . $tipos[0]->name . '</span>';
                            }
                        ?>
                    </div>
                    
                    <div class="botao">
                        <a href="<?php the_permalink(); ?>">Saber mais</a>
                    </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
        ?>
    </section>

</main>

<?php get_footer(); ?>
