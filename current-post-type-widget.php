<?php
class List_Current_Post_Type_Widget extends WP_Widget{

    function __construct(){
        parent::__construct(
            'list-current-post-type',  // Base ID
            'List Custom Post Type',   // Name
            ['description' => __( 'Lists all the posts that match the current post\'s post type' , 'bkn' )]
        );
        add_action('widgets_init', function(){
            register_widget( 'List_Current_Post_Type_Widget');
        });
    }

    public $args = [
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    ];

    public function widget($args, $instance){
        $post_type = get_post_type();
        if(!empty($post_type) && !in_array($post_type, ['post', 'page', 'attachment', 'event'])) {
            $title = (isset($instance['title']) && !empty($instance['title'])) ? $instance['title'] :
                get_post_type_object($post_type)->labels->all_items;
            echo $args['before_widget'] .
                $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'] .
                '<div class="list-current-post-type-widget">';
            $query = (new WP_Query([
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ]))->get_posts();
            foreach ($query as $post) {
                echo '<a href="' . get_permalink($post->ID) . '">' .
                    get_the_post_thumbnail($post->ID, 'thumbnail') .
                    '<span>' . esc_html($post->post_title) . '</span></a>';
            }

            echo '</div>' .
                $args['after_widget'];
        }
    }

    public function form($instance) {
        $title = !empty($instance['title'])? $instance['title'] : esc_html__('', 'bkn');
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title']))? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}
$my_widget = new List_Current_Post_Type_Widget();
?>