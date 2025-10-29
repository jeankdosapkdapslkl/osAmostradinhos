<?php get_header(); ?>

<main class="site-main">

    <div class="right-left-container">

        <!-- LEFT: 4 posts seguintes -->
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
                <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- RIGHT: últimos 4 posts -->
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

</main>

<?php get_footer(); ?>
