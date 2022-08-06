<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php if (is_singular()) {
            echo '<h1 class="entry-title">';
            if (!is_search()) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            <?php
            }
            echo '</h1>';
        } ?>
    </header>
    <?php get_template_part('entry', (is_front_page() || is_home() || is_archive() || is_search()? 'summary' : 'content'));
    if ( is_singular() ) {
        get_template_part( 'entry-footer' );
    }
    ?>
</article>