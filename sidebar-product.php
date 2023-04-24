    <aside id="sidebar">
        <?php if ( is_active_sidebar( 'product-sidebar' ) ) : ?>
            <div id="primary" class="widget-area">
                <ul class="xoxo">
                    <?php dynamic_sidebar( 'product-sidebar' ); ?>
                </ul>
            </div>
        <?php endif; ?>
    </aside>