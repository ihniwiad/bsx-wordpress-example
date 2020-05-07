<?php 

// paths

$rootPath = get_template_directory().'/';
$resourcesPath = 'resources/';
$assetsPath = $rootPath.'assets/';
    

/**
 * REQUIRED FILES
 * Include required files.
 */

// Custom page walker.
require get_template_directory().'/classes/class-bsx-walker-page.php';
require get_template_directory().'/classes/include-classes.php';


/**
 * WordPress titles
 */
add_theme_support( 'title-tag' );


/**
 * add scripts and stylesheets
 *
 * TODO: why doing this instead of including one css file (+ atf style?) and vendor and scripts js? 
 */ 
/*
function include_css_and_js() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.6' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/assets/css/blog.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
}

add_action( 'wp_enqueue_scripts', 'include_css_and_js' );
*/

/**
 * disable emoji
 */

function disable_wp_emojicons() {
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
    return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}


/**
 * remove WordPress admin bar
 */
/*
function remove_admin_bar() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'remove_admin_bar' );
*/


/**
 * add Open Graph Meta Tags
 */

function meta_og() {
    global $post;

    if ( is_single() ) {
        if( has_post_thumbnail( $post->ID ) ) {
            $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
        } 
        $excerpt = strip_tags( $post->post_content );
        $excerpt_more = '';
        if ( strlen($excerpt ) > 155) {
            $excerpt = substr( $excerpt,0,155 );
            $excerpt_more = ' ...';
        }
        $excerpt = str_replace( '"', '', $excerpt );
        $excerpt = str_replace( "'", '', $excerpt );
        $excerptwords = preg_split( '/[\n\r\t ]+/', $excerpt, -1, PREG_SPLIT_NO_EMPTY );
        array_pop( $excerptwords );
        $excerpt = implode( ' ', $excerptwords ) . $excerpt_more;
        ?>
<meta name="author" content="Your Name">
<meta name="description" content="<?php echo $excerpt; ?>">
<meta property="og:title" content="<?php echo the_title(); ?>">
<meta property="og:description" content="<?php echo $excerpt; ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo the_permalink(); ?>">
<meta property="og:site_name" content="Your Site Name">
<meta property="og:image" content="<?php echo $img_src[0]; ?>">
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'meta_og', 5);


/**
 * custom settings
 */

function custom_settings_add_menu() {
	add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );


/**
 * create custom global settings
 */

function custom_settings_page() { ?>
	<div class="wrap">
		<h1>Custom Settings</h1>
		<form method="post" action="options.php">
				<?php
					settings_fields( 'section' );
					do_settings_sections( 'theme-options' );
					submit_button();
				?>
		</form>
	</div>
<?php }

// Twitter
function setting_twitter() { ?>
	<input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

// GitHub
function setting_github() { ?>
	<input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

// Facebook
function setting_facebook() { ?>
	<input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

function custom_settings_page_setup() {
	add_settings_section( 'section', 'All Settings', null, 'theme-options' );

	add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
	add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );
	add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );

	register_setting('section', 'twitter');
	register_setting( 'section', 'github' );
	register_setting( 'section', 'facebook' );
}
add_action( 'admin_init', 'custom_settings_page_setup' );


/**
 * enable featured images
 */

add_theme_support( 'post-thumbnails' );


/**
 * custom post type
 */

function create_custom_post() {
    register_post_type( 'custom',
        array(
            'labels' => array(
                'name' => __( 'Custom Post' ),
                'singular_name' => __( 'Custom Post' ),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'custom-fields'
            )
        )
    );
}
add_action( 'init', 'create_custom_post' );


/**
 * custom another post type (references)
 */

function create_references_post() {
    register_post_type( 'references',
        array(
            'labels'       => array(
                'name'       => __( 'References Post' ),
            ),
            'public'       => true,
            'hierarchical' => true,
            'has_archive'  => true,
            'supports'     => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
            ),
            'taxonomies'   => array(
                'post_tag',
                'category',
            )
        )
    );
    register_taxonomy_for_object_type( 'category', 'references' );
    register_taxonomy_for_object_type( 'post_tag', 'references' );
}
add_action( 'init', 'create_references_post' );


/**
 * add custom fields meta box
 */

function add_your_fields_meta_box() {
    add_meta_box(
        'references_meta_box', // $id
        'References Fields', // $title
        'show_your_fields_meta_box', // $callback
        'references-test', // $screen
        'normal', // $context
        'high' // $priority
    );
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );



function show_your_fields_meta_box() {

    global $post;

    $meta = get_post_meta( $post->ID, 'references_fields', true ); 

    //echo( '<div>print_r( $post ): '.print_r( $post ).'</div>' );
    //echo( '<div>print_r( $meta ): '.print_r( $meta ).'</div>' );

    ?>

        <input type="hidden" name="references_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

        <p>
            <label for="references_fields[text]">Input Text</label>
            <br>
            <input type="text" name="references_fields[text]" id="references_fields[text]" class="regular-text" value="<?php if (is_array( $meta ) && isset( $meta['text'] ) ) { echo $meta['text']; } ?>">
        </p>

        <p>
            <label for="references_fields[textarea]">Textarea</label>
            <br>
            <textarea name="references_fields[textarea]" id="references_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php if ( is_array($meta) && isset( $meta['textarea'] ) ) echo $meta['textarea']; ?></textarea>
        </p>

        <p>
            <label for="references_fields[checkbox]">Checkbox
            <input type="checkbox" name="references_fields[checkbox]" value="1" <?php if ( is_array( $meta ) && isset( $meta['checkbox'] ) && $meta['checkbox'] == 1 ) echo 'checked' ?>>
            </label>
        </p>

        <p>
            <label for="references_fields[select]">Select Menu</label>
            <br>
            <select name="references_fields[select]" id="references_fields[select]">
                <option value="option-one" <?php if ( is_array( $meta ) && isset( $meta['select'] ) && $meta['select'] === 'option-one' ) echo 'checked'; ?>>Option One</option>
                <option value="option-two" <?php if ( is_array( $meta ) && isset( $meta['select'] ) && $meta['select'] === 'option-two' ) echo 'checked'; ?>>Option Two</option>
            </select>
        </p>

        <p>
            <label for="references_fields[image]">Image Upload</label><br>
            <input type="text" name="references_fields[image]" id="references_fields[image]" class="meta-image regular-text" value="<?php if (is_array( $meta ) && isset( $meta['image'] ) ) { echo $meta['image']; } ?>">
            <input type="button" class="button image-upload" value="Browse">
        </p>
        <?php if ( is_array( $meta ) && isset( $meta['image'] ) ) { ?>
            <div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>
        <?php } ?>
        <script>
            jQuery(document).ready(function($) {
                // Instantiates the variable that holds the media library frame.
                var meta_image_frame
                // Runs when the image button is clicked.
                $('.image-upload').click(function(e) {
                    // Get preview pane
                    var meta_image_preview = $(this)
                        .parent()
                        .parent()
                        .children('.image-preview')
                    // Prevents the default action from occuring.
                    e.preventDefault()
                    var meta_image = $(this)
                        .parent()
                        .children('.meta-image')
                    // If the frame already exists, re-open it.
                    if (meta_image_frame) {
                        meta_image_frame.open()
                        return
                    }
                    // Sets up the media library frame
                    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                        title: meta_image.title,
                        button: {
                            text: meta_image.button,
                        },
                    })
                    // Runs when an image is selected.
                    meta_image_frame.on('select', function() {
                        // Grabs the attachment selection and creates a JSON representation of the model.
                        var media_attachment = meta_image_frame
                            .state()
                            .get('selection')
                            .first()
                            .toJSON()
                        // Sends the attachment URL to our custom image input field.
                        meta_image.val(media_attachment.url)
                        meta_image_preview.children('img').attr('src', media_attachment.url)
                    })
                    // Opens the media library frame.
                    meta_image_frame.open()
                })
            })
        </script>

    <?php 

}


function save_your_fields_meta( $post_id ) {
    // verify nonce
    if ( !wp_verify_nonce( $_POST['references_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } 
        elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    $old = get_post_meta( $post_id, 'references_fields', true );
    $new = $_POST['references_fields'];

    if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'references_fields', $new );
    } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'references_fields', $old );
    }
}
add_action( 'save_post', 'save_your_fields_meta' );


