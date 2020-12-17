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
 * remove block editor styles from frontend.
 */

function remove_editor_blocks_assets() {
    if ( ! is_admin() ) {
        wp_dequeue_style( 'editor-blocks' );
    }
}
add_action( 'enqueue_block_assets', 'remove_editor_blocks_assets' );


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
    } 
    else {
        return;
    }
}
add_action( 'wp_head', 'meta_og', 5 );


/**
 * remove admin bar
 */

function remove_admin_bar() {
    //if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
        show_admin_bar( false );
    //}
}
add_action( 'after_setup_theme', 'remove_admin_bar' );


/**
 * remove block library css
 */

function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );



/**
 * remove more unwanted embed stuff
 */
    
add_action( 'init', function() {
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}, PHP_INT_MAX - 1 );


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

// phone
function setting_phone() { ?>
    <input type="text" name="phone" id="phone" value="<?php echo get_option( 'phone' ); ?>" />
<?php }

// mail
function setting_mail() { ?>
    <input type="text" name="mail" id="mail" value="<?php echo get_option( 'mail' ); ?>" />
<?php }

// show phone & mail in footer
function setting_footer_phone_mail_show() { ?>
    <label><input type="checkbox" name="footer_phone_mail_show" id="footer_phone_mail_show" value="1" <?php if ( get_option('footer_phone_mail_show') ) echo 'checked' ?> />Yes</label>
<?php }

// Facebook
function setting_facebook() { ?>
    <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

// Twitter
function setting_twitter() { ?>
    <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

// Instagram
function setting_instagram() { ?>
    <input type="text" name="instagram" id="instagram" value="<?php echo get_option( 'instagram' ); ?>" />
<?php }

// Google Plus
function setting_googleplus() { ?>
    <input type="text" name="googleplus" id="googleplus" value="<?php echo get_option( 'googleplus' ); ?>" />
<?php }

// Xing
function setting_xing() { ?>
    <input type="text" name="xing" id="xing" value="<?php echo get_option( 'xing' ); ?>" />
<?php }

// use social media colors
function setting_social_media_colors_use() { ?>
    <label><input type="checkbox" name="social_media_colors_use" id="social_media_colors_use" value="1" <?php if ( get_option('social_media_colors_use') ) echo 'checked' ?> />Yes</label>
<?php }

// GitHub
function setting_github() { ?>
    <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

// footer links
/*
// function print_footer_link_input( $number, $type ) { ?>
//     <input type="text" name="<?php echo "footer_link_$number_$type"; ?>" id="<?php echo "footer_link_$number_$type"; ?>" value="<?php echo get_option( "footer_link_$number_$type" ); ?>" />
// <?php }
*/
function print_footer_link_0_title_input() { ?>
    <input type="text" name="footer_link_0_title" id="footer_link_0_title" value="<?php echo get_option( 'footer_link_0_title' ); ?>" />
<?php }
function print_footer_link_0_url_input() { ?>
    <input type="text" name="footer_link_0_url" id="footer_link_0_url" value="<?php echo get_option( 'footer_link_0_url' ); ?>" />
<?php }
function print_footer_link_1_title_input() { ?>
    <input type="text" name="footer_link_1_title" id="footer_link_1_title" value="<?php echo get_option( 'footer_link_1_title' ); ?>" />
<?php }
function print_footer_link_1_url_input() { ?>
    <input type="text" name="footer_link_1_url" id="footer_link_1_url" value="<?php echo get_option( 'footer_link_1_url' ); ?>" />
<?php }
function print_footer_link_2_title_input() { ?>
    <input type="text" name="footer_link_2_title" id="footer_link_2_title" value="<?php echo get_option( 'footer_link_2_title' ); ?>" />
<?php }
function print_footer_link_2_url_input() { ?>
    <input type="text" name="footer_link_2_url" id="footer_link_2_url" value="<?php echo get_option( 'footer_link_2_url' ); ?>" />
<?php }


function custom_settings_page_setup() {

    // contact
    add_settings_section( 'contact_section', 'Contact Settings', null, 'theme-options' );

    add_settings_field( 'phone', 'Phone', 'setting_phone', 'theme-options', 'contact_section' );
    add_settings_field( 'mail', 'Mail', 'setting_mail', 'theme-options', 'contact_section' );
    add_settings_field( 'footer_phone_mail_show', 'Show Phone & Mail in footer', 'setting_footer_phone_mail_show', 'theme-options', 'contact_section' );

    register_setting( 'section', 'phone' );
    register_setting( 'section', 'mail' );
    register_setting( 'section', 'footer_phone_mail_show' );

    // social media
    add_settings_section( 'social_media_section', 'Social Media Settings', null, 'theme-options' );

    add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'social_media_section' );
    add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'social_media_section' );
    add_settings_field( 'instagram', 'Instagram URL', 'setting_instagram', 'theme-options', 'social_media_section' );
    add_settings_field( 'googleplus', 'Google Plus URL', 'setting_googleplus', 'theme-options', 'social_media_section' );
    add_settings_field( 'xing', 'Xing URL', 'setting_xing', 'theme-options', 'social_media_section' );
    add_settings_field( 'social_media_colors_use', 'Use Social Media colors in footer', 'setting_social_media_colors_use', 'theme-options', 'social_media_section' );

    register_setting( 'section', 'facebook' );
    register_setting( 'section', 'twitter' );
    register_setting( 'section', 'instagram' );
    register_setting( 'section', 'googleplus' );
    register_setting( 'section', 'xing' );
    register_setting( 'section', 'social_media_colors_use' );

    // footer links
    add_settings_section( 'footer_links_section', 'Footer Links', null, 'theme-options' );

    // $footer_links_ids = array( '0', '1', '2' );
    // $footer_links_types = array( 'title', 'url' );
    // print( '<script> console.log( "TEST: add_settings_section" ); </script>' );
    // foreach ( $footer_links_ids as $id ) {
    //     print( '<script> console.log( "TEST: ' . $id . '" ); </script>' );
    //     foreach ( $footer_links_types as $type ) {
    //         add_settings_field( "footer_link_$id_$type", "Footer Link $id $type", "print_footer_link_input( $number, $type )", 'theme-options', 'footer_links_section' );
    //         register_setting( 'section', "footer_link_$id_$type" );
    //     }
    // }

    add_settings_field( 'footer_link_0_title', 'Footer Link 1 Title', 'print_footer_link_0_title_input', 'theme-options', 'footer_links_section' );
    add_settings_field( 'footer_link_0_url', 'Footer Link 1 URL', 'print_footer_link_0_url_input', 'theme-options', 'footer_links_section' );
    add_settings_field( 'footer_link_1_title', 'Footer Link 2 Title', 'print_footer_link_1_title_input', 'theme-options', 'footer_links_section' );
    add_settings_field( 'footer_link_1_url', 'Footer Link 2 URL', 'print_footer_link_1_url_input', 'theme-options', 'footer_links_section' );
    add_settings_field( 'footer_link_2_title', 'Footer Link 3 Title', 'print_footer_link_2_title_input', 'theme-options', 'footer_links_section' );
    add_settings_field( 'footer_link_2_url', 'Footer Link 3 URL', 'print_footer_link_2_url_input', 'theme-options', 'footer_links_section' );

    register_setting( 'section', 'footer_link_0_title' );
    register_setting( 'section', 'footer_link_0_url' );
    register_setting( 'section', 'footer_link_1_title' );
    register_setting( 'section', 'footer_link_1_url' );
    register_setting( 'section', 'footer_link_2_title' );
    register_setting( 'section', 'footer_link_2_url' );

    // dev
    add_settings_section( 'dev_section', 'Dev Settings', null, 'theme-options' );

    add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'dev_section' );

    register_setting( 'section', 'github' );

}
add_action( 'admin_init', 'custom_settings_page_setup' );


/**
 * enable featured images
 */

add_theme_support( 'post-thumbnails' );


// /**
//  * custom post type
//  */

// function create_custom_post() {
//     register_post_type( 'custom',
//         array(
//             'labels' => array(
//                 'name' => __( 'Custom Post' ),
//                 'singular_name' => __( 'Custom Post' ),
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'supports' => array(
//                 'title',
//                 'editor',
//                 'thumbnail',
//                 'custom-fields'
//             )
//         )
//     );
// }
// add_action( 'init', 'create_custom_post' );


// /**
//  * custom another post type (references)
//  */

// function create_references_post() {
//     register_post_type( 'references',
//         array(
//             'labels'       => array(
//                 'name'       => __( 'References Post' ),
//             ),
//             'public'       => true,
//             'hierarchical' => true,
//             'has_archive'  => true,
//             'supports'     => array(
//                 'title',
//                 'editor',
//                 'excerpt',
//                 'thumbnail',
//             ),
//             'taxonomies'   => array(
//                 'post_tag',
//                 'category',
//             )
//         )
//     );
//     register_taxonomy_for_object_type( 'category', 'references' );
//     register_taxonomy_for_object_type( 'post_tag', 'references' );
// }
// add_action( 'init', 'create_references_post' );


// /**
//  * add custom fields meta box
//  */

// function add_your_fields_meta_box() {
//     add_meta_box(
//         'references_meta_box', // $id
//         'References Fields', // $title
//         'show_your_fields_meta_box', // $callback
//         'references-test', // $screen
//         'normal', // $context
//         'high' // $priority
//     );
// }
// add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );
/*
// function show_your_fields_meta_box() {

//     global $post;

//     $meta = get_post_meta( $post->ID, 'references_fields', true ); 

//     //echo( '<div>print_r( $post ): '.print_r( $post ).'</div>' );
//     //echo( '<div>print_r( $meta ): '.print_r( $meta ).'</div>' );

//     ?>

//         <input type="hidden" name="references_fields_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

//         <p>
//             <label for="references_fields[text]">Input Text</label>
//             <br>
//             <input type="text" name="references_fields[text]" id="references_fields[text]" class="regular-text" value="<?php if (is_array( $meta ) && isset( $meta['text'] ) ) { echo $meta['text']; } ?>">
//         </p>

//         <p>
//             <label for="references_fields[textarea]">Textarea</label>
//             <br>
//             <textarea name="references_fields[textarea]" id="references_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php if ( is_array($meta) && isset( $meta['textarea'] ) ) echo $meta['textarea']; ?></textarea>
//         </p>

//         <p>
//             <label for="references_fields[checkbox]">Checkbox
//             <input type="checkbox" name="references_fields[checkbox]" value="1" <?php if ( is_array( $meta ) && isset( $meta['checkbox'] ) && $meta['checkbox'] == 1 ) echo 'checked' ?>>
//             </label>
//         </p>

//         <p>
//             <label for="references_fields[select]">Select Menu</label>
//             <br>
//             <select name="references_fields[select]" id="references_fields[select]">
//                 <option value="option-one" <?php if ( is_array( $meta ) && isset( $meta['select'] ) && $meta['select'] === 'option-one' ) echo 'checked'; ?>>Option One</option>
//                 <option value="option-two" <?php if ( is_array( $meta ) && isset( $meta['select'] ) && $meta['select'] === 'option-two' ) echo 'checked'; ?>>Option Two</option>
//             </select>
//         </p>

//         <p>
//             <label for="references_fields[image]">Image Upload</label><br>
//             <input type="text" name="references_fields[image]" id="references_fields[image]" class="meta-image regular-text" value="<?php if (is_array( $meta ) && isset( $meta['image'] ) ) { echo $meta['image']; } ?>">
//             <input type="button" class="button image-upload" value="Browse">
//         </p>
//         <?php if ( is_array( $meta ) && isset( $meta['image'] ) ) { ?>
//             <div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>
//         <?php } ?>
//         <script>
//             jQuery(document).ready(function($) {
//                 // Instantiates the variable that holds the media library frame.
//                 var meta_image_frame
//                 // Runs when the image button is clicked.
//                 $('.image-upload').click(function(e) {
//                     // Get preview pane
//                     var meta_image_preview = $(this)
//                         .parent()
//                         .parent()
//                         .children('.image-preview')
//                     // Prevents the default action from occuring.
//                     e.preventDefault()
//                     var meta_image = $(this)
//                         .parent()
//                         .children('.meta-image')
//                     // If the frame already exists, re-open it.
//                     if (meta_image_frame) {
//                         meta_image_frame.open()
//                         return
//                     }
//                     // Sets up the media library frame
//                     meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
//                         title: meta_image.title,
//                         button: {
//                             text: meta_image.button,
//                         },
//                     })
//                     // Runs when an image is selected.
//                     meta_image_frame.on('select', function() {
//                         // Grabs the attachment selection and creates a JSON representation of the model.
//                         var media_attachment = meta_image_frame
//                             .state()
//                             .get('selection')
//                             .first()
//                             .toJSON()
//                         // Sends the attachment URL to our custom image input field.
//                         meta_image.val(media_attachment.url)
//                         meta_image_preview.children('img').attr('src', media_attachment.url)
//                     })
//                     // Opens the media library frame.
//                     meta_image_frame.open()
//                 })
//             })
//         </script>

//     <?php 

// }
*/

// function save_your_fields_meta( $post_id ) {
//     // verify nonce
//     if ( !wp_verify_nonce( $_POST['references_fields_meta_box_nonce'], basename(__FILE__) ) ) {
//         return $post_id;
//     }
//     // check autosave
//     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
//         return $post_id;
//     }
//     // check permissions
//     if ( 'page' === $_POST['post_type'] ) {
//         if ( !current_user_can( 'edit_page', $post_id ) ) {
//             return $post_id;
//         } 
//         elseif ( !current_user_can( 'edit_post', $post_id ) ) {
//             return $post_id;
//         }
//     }

//     $old = get_post_meta( $post_id, 'references_fields', true );
//     $new = $_POST['references_fields'];

//     if ( $new && $new !== $old ) {
//         update_post_meta( $post_id, 'references_fields', $new );
//     } elseif ( '' === $new && $old ) {
//         delete_post_meta( $post_id, 'references_fields', $old );
//     }
// }
// add_action( 'save_post', 'save_your_fields_meta' );






function add_nav_fields_meta_box() {
    $screen = "page"; // choose 'post' or 'page'

    add_meta_box( 
        'nav_meta_box', // $id
        'Navigation Fields', // $title
        'show_nav_fields_meta_box', // $callback
        $screen, // $screen
        'side', // $context, choose 'normal' or 'side')
        'default', // $priority
        null 
    );
}
add_action( 'add_meta_boxes', 'add_nav_fields_meta_box' );

function show_nav_fields_meta_box() {
    
    global $post;

    $meta = get_post_meta( $post->ID, 'nav_fields', true ); 

    // echo( '<div>print_r( $post ): '.print_r( $post ).'</div>' );
    // echo( '<div>print_r( $meta ): '.print_r( $meta ).'</div>' );

    ?>

        <input type="hidden" name="nav_fields_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

        <p>
            <label for="nav_fields[hidden_in_main_nav]">Hidden in main navigation
            <input type="checkbox" name="nav_fields[hidden_in_main_nav]" value="1" <?php if ( is_array( $meta ) && isset( $meta['hidden_in_main_nav'] ) && $meta['hidden_in_main_nav'] == 1 ) echo 'checked' ?>>
            </label>
        </p>

        <p>
            <label for="nav_fields[nav_type]">Nav type (optional, set 1 for big menu, 2...4 for columns)</label>
            <br>
            <input type="number" name="nav_fields[nav_type]" id="nav_fields[nav_type]" value="<?php if (is_array( $meta ) && isset( $meta['nav_type'] ) ) { echo $meta['nav_type']; } ?>">
        </p>

    <?php 

}

function save_nav_fields_meta( $post_id ) {
    // verify nonce
    if ( isset( $_POST['nav_fields_meta_box_nonce'] ) && !wp_verify_nonce( $_POST['nav_fields_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    // check permissions
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } 
        elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    if ( isset( $_POST['nav_fields'] ) ) {

        $old = get_post_meta( $post_id, 'nav_fields', true );
        $new = $_POST['nav_fields'];

        if ( $new && $new !== $old ) {
            update_post_meta( $post_id, 'nav_fields', $new );
        } elseif ( '' === $new && $old ) {
            delete_post_meta( $post_id, 'nav_fields', $old );
        }

    }
}
add_action( 'save_post', 'save_nav_fields_meta' );


// manage allowed block types

function myplugin_allowed_block_types( $allowed_block_types, $post ) {     
    if ( $post->post_type !== 'page' || $post->post_type !== 'post' ) {
        return array( 
            'core/paragraph', 
            'core/heading', 
            'core/list', 
            'bsx-blocks/banner',
            'bsx-blocks/button', 
            'bsx-blocks/buttons', 
            'bsx-blocks/column-row', 
            'bsx-blocks/column-rows', 
            'bsx-blocks/container', 
            'bsx-blocks/groups', 
            'bsx-blocks/img-gallery', 
            'bsx-blocks/lazy-img', 
            'bsx-blocks/col', 
            'bsx-blocks/row-with-cols', 
            'bsx-blocks/section', 
            'bsx-blocks/wrapper', 
        );
    }
 
    return $allowed_block_types;
}
 
add_filter( 'allowed_block_types', 'myplugin_allowed_block_types', 10, 2 );

