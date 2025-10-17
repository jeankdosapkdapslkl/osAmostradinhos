<?php get_header(); ?>

<main class="site-main container">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="atrativo-single">
            <h1 class="atrativo-titulo"><?php the_title(); ?></h1>

            <?php if (has_post_thumbnail()) : ?>
                <div class="atrativo-imagem">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="atrativo-conteudo">
                <?php the_content(); ?>
            </div>

            <?php
            $tipos = get_the_terms(get_the_ID(), 'tipo_atrativo');
            if ($tipos && !is_wp_error($tipos)) :
                echo '<div class="atrativo-tipos"><strong>Tipo de atrativo:</strong> ';
                $nomes = wp_list_pluck($tipos, 'name');
                echo esc_html(implode(', ', $nomes));
                echo '</div>';
            endif;
            ?>

            <div class="voltar">
                <a href="<?php echo get_post_type_archive_link('atrativos'); ?>">← Voltar para todos os atrativos</a>
            </div>
        </article>
    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
