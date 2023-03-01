    </div><!-- #container -->
    <footer id="footer">
        <nav id="footer-menu">
            <?php if (is_active_sidebar('footer-widget-area-1')) { ?>
                <div class="footer-widget-area-1 widget-area" role="complementary">
                    <?php dynamic_sidebar('footer-widget-area-1'); ?>
                </div>
            <?php } ?>
            <?php if (is_active_sidebar('footer-widget-area-2')) { ?>
                <div class="footer-widget-area-2 widget-area" role="complementary">
                    <?php dynamic_sidebar('footer-widget-area-2'); ?>
                </div>
            <?php } ?>
            <?php if (is_active_sidebar('footer-widget-area-3')) { ?>
                <div class="footer-widget-area-3 widget-area" role="complementary">
                    <?php dynamic_sidebar('footer-widget-area-3'); ?>
                </div>
            <?php } ?>
        </nav>
        <!--<div class="copyright">
            &copy; <?php echo esc_html( date_i18n( __( 'Y', 'bkn' ) ) ); ?> &ndash; <?php _e('Brony Kindness Network', 'bkn'); ?>
        </div>-->
    </footer>
</div><!-- #wrapper -->
<?php if(is_woocommerce_activated()){
    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_count_text = ($cart_count > 99) ? '99+' : $cart_count;
    if($cart_count > 0 && !is_cart() && !is_checkout() && !is_checkout_pay_page()) { ?>
<a href="/cart" id="go-to-cart" title="Go to cart" aria-hidden="true"><span class="fas fa-shopping-bag"></span><span class="count"><?php echo $cart_count_text ?></span></a>
<?php }
} ?>
<a href="#" id="return-to-top" title="Go to top" aria-hidden="true"><span class="fas fa-chevron-up"></span></a>
<?php wp_footer(); ?>
</body>
</html>