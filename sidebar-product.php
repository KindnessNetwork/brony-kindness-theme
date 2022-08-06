    <aside id="sidebar">
        <?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
            <div id="primary" class="widget-area">
                <ul class="xoxo">
                    <?php dynamic_sidebar( 'product-widget-area' ); ?>
                </ul>
            </div>
        <?php endif; ?>
    </aside>