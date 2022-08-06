<div class="entry-summary">
    <?php if (has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    <?php } ?>
    <div class="the-excerpt">
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>
        <?php if (!is_search()) {
            get_template_part( 'entry', 'meta' );
        } ?>
        <?php the_excerpt(); ?>
        <?php if (is_search()) { ?>
            <div class="entry-links"><?php wp_link_pages(); ?></div>
        <?php } ?>
    </div>
</div>