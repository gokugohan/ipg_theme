<?php

//http://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-wordpress-widget/
// Creating the widget 
class the_president_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'the_president', __('The President Widget', 'the_president_domain'), array(
            'description' => __('Widget for the president - IPG', 'the_president_domain'),
                )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        include '/ipg_widget_the_president_content.php';
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('The president', 'the_president_domain');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

// Class wpb_widget ends here
// Register and load the widget
function the_president_load_widget() {
    register_widget('the_president_widget');
}

add_action('widgets_init', 'the_president_load_widget');
