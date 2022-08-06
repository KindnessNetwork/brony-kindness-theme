<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <button class="toggle-hide" aria-hidden="true">
        <span class="fas fa-search fa-lg" aria-hidden="true"></span>
    </button>
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field"
               placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder' ) ?>"
               value="<?php echo get_search_query() ?>" name="s"
               title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button' ) ?></span>
        <span class="far fa-arrow-right fa-lg" aria-hidden="true"></span>
    </button>
</form>