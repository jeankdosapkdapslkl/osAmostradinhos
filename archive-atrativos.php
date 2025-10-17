<?php get_header(); ?>

<main class="archive-atrativos container">

    <h1 class="page-title">Atrativos</h1>

    <?php if (have_posts()) : ?>
        <div class="atrativos-lista">
            <?php while (have_posts()) : the_post(); ?>
                <article class="atrativo-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="atrativo-thumb">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="paginacao">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p>Nenhum atrativo encontrado.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>