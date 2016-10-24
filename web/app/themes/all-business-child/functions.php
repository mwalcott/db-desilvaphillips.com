<?php
/**
 * @package 	WordPress
 * @subpackage 	All Business Child
 * @version		1.0.0
 * 
 * Child Theme Functions File
 * Created by CMSMasters
 * 
 */


function all_business_enqueue_styles() {
    $parent_style = 'theme-style';
	
	
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
	
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action('wp_enqueue_scripts', 'all_business_enqueue_styles');

function de_widgets_init() {

	register_sidebar( array(
		'name'          => 'Sector Sidebar',
		'id'            => 'sector_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="sector-side-heading">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'de_widgets_init' );


// Creating the widget 
class wpb_widget extends WP_Widget {

function __construct() {
	parent::__construct(
		// Base ID of your widget
		'wpb_widget', 
		
		// Widget name will appear in UI
		__('Footer Block', 'wpb_widget_domain'), 
		
		// Widget description
		array( 'description' => __( '', 'wpb_widget_domain' ), ) 
	);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget']; ?>
	
		<p><img src="/app/uploads/2016/10/logo-alt.png"/></p>
		<p><img src="/app/uploads/2016/10/oaklins-blue.png"/></p>
		<ul>
			<li class="address">
				Main Office 475 Park Avenue South, 22nd Floor<br />
				New York, NY 10016
			</li>
			<li class="phone">212.686.9700</li>	
			<li class="mail"><a href="/contact">Email Us</a></li>
		</ul>	
		<?php gravity_form( 3, true, false, false, '', false ); ?>
	<?php echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}
	else {
		$title = __( 'New title', 'wpb_widget_domain' );
	}
	// Widget admin form
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
?>