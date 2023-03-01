<?php get_header(); ?>
    <main id="content" class="standard">
        <?php if (have_posts()){
            while (have_posts()){
                the_post(); ?>
                <?php bkn_do_slider_or_image() ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-wrapper">
                <div class="article-wrapper">
                    <div class="entry-content">
                        <?php if ( has_post_thumbnail() ){ ?>
                            <?php the_post_thumbnail(); ?>
                        <?php } ?>
                        <?php the_content(); ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                    <?php if (comments_open() && !post_password_required()) {
                        comments_template( '', true );
                    } ?>
                </div>
            </div>
        </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>