<?php
/*
Plugin Name: Earthquake Widget
*/

//http://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-wordpress-widget/
// Creating the widget 
class earthquake_widget extends WP_Widget {

    function __construct() {
		
        parent::__construct(
            'earthquake_widget', 'Earthquake Widget',
			array(
				'classname' => 'earthquake_widget',
				'description' => 'Widget for Earthquake - IPG'				
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
        include dirname(__FILE__) . '/ipg_widget_mapa.php';
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Earthquake', 'earthquake_widget_domain');
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
function earthquake_load_widget() {
    register_widget('earthquake_widget');
}

//wp_enqueue_style( 'earthquake-style', plugins_url('style.css', __FILE__) );
add_action('widgets_init', 'earthquake_load_widget');