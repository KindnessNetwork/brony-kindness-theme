<?php get_header(); ?>
    <main id="content" class="standard">
        <?php
        if (have_posts()){
            while (have_posts()){
                the_post(); ?>
                <?php bkn_do_slider_or_image() ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <a class="button" href="<?php echo get_permalink(wc_get_page_id('shop' )); ?>">
                            <i class="far fa-chevron-left" aria-hidden="true"></i>
                            Return to Shop
                        </a>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-wrapper">
                        <div class="article-wrapper">
                            <div class="entry-content">
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            </div>
                            <?php /* if (comments_open() && !post_password_required()) {
                                comments_template( '', true );
                            } */ ?>
                        </div>
                    </div>
                </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>