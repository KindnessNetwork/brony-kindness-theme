<?php
/**
 * Template Name: Homepage
 */
get_header(); ?>
    <main id="content" class="standard">
        <?php if (have_posts()){
            while (have_posts()){
                the_post();
                bkn_do_slider_or_image(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-wrapper">
                        <div class="article-wrapper">
                            <div class="entry-content">
                                <?php if ( has_post_thumbnail() ){ ?>
                                    <div class="entry-column-wrapper">
                                        <div class="entry-image">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                        <div class="entry-content-column">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <?php the_content(); ?>
                                <?php } ?>
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
        <div class="news-wrapper" style="display: none;">
            <hr>
            <h2 class="news-title">LATEST NEWS</h2>
            <?php $the_query = new WP_Query( array(
                'category_name' => 'news',
                'posts_per_page' => 3,
            )); ?>
            <?php if ($the_query->have_posts()) { ?>
                <div class="news-container">
                <?php while ($the_query->have_posts()) {
                    $the_query->the_post(); ?>
                    <div class="news-item">
                        <?php the_post_thumbnail(); ?>
                        <div class="news-content">
                            <h3><?php the_title(); ?></h3>
                            <a href="<?php echo get_permalink(); ?>">READ MORE</a>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php wp_reset_postdata();
            } else { ?>
                <p><?php __('No News :\'('); ?></p>
            <?php } ?>
        </div>
    </main>
<?php get_footer(); ?>