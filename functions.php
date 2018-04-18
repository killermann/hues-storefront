<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

 //Making jQuery to load from Google Library
 function replace_jquery() {
 	if (!is_admin()) {
 		// comment out the next two lines to load the local copy of jQuery
 		wp_deregister_script('jquery');
 		wp_register_script('jquery', '//code.jquery.com/jquery-2.1.4.min.js', false, '1.11.3');
 		wp_enqueue_script('jquery');
 	}
 }
 add_action('init', 'replace_jquery');

// REMOVE DEFAULT GOOGLE FontAwesome
function dequeue_default_google_fonts() {
    wp_dequeue_style( 'storefront-fonts');
}
add_action( 'wp_enqueue_scripts', 'dequeue_default_google_fonts', 999);

// //* TN Dequeue Styles - Remove Font Awesome from WordPress theme
// add_action( 'wp_print_styles', 'tn_dequeue_font_awesome_style' );
// function tn_dequeue_font_awesome_style() {
//       wp_dequeue_style( 'storefront-icons' );
//       wp_deregister_style( 'storefront-icons' );
// }

function remove_storefront_sidebar() {
    if ( is_product() || is_checkout() || is_cart() || is_product() ) {
    remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
    }
}

add_action( 'get_header', 'remove_storefront_sidebar' );


function rearrange_storefront_header() {
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
    add_action( 'storefront_header', 'storefront_secondary_navigation', 1 );
    add_action( 'storefront_header', 'storefront_header_cart', 80 );
    add_action( 'storefront_header', 'storefront_product_search', 50 );
}
add_action( 'init' , 'rearrange_storefront_header' , 1);


function z_remove_wc_breadcrumbs() {
    remove_action( 'storefront_content_top', 'woocommerce_breadcrumb', 10);
}

add_action( 'init', 'z_remove_wc_breadcrumbs');

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function remove_pgz_theme_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'remove_pgz_theme_support', 100 );


 // Load Custom JavaScript via Child Theme

 function my_scripts_method() {
     wp_enqueue_script(
         'custom-script',
         get_stylesheet_directory_uri() . '/inc/js/custom.js',
         array( 'jquery' )
     );
 }


 add_action( 'wp_enqueue_scripts', 'my_scripts_method' );


 /************* OVERWRITING THEME FUNCTIONS **************/

function remove_homepage_hooks() {
    remove_action( 'homepage', 'storefront_homepage_content',      10 );
    remove_action( 'homepage', 'storefront_product_categories',    20 );
    remove_action( 'homepage', 'storefront_recent_products',       30 );
    remove_action( 'homepage', 'storefront_popular_products',      50 );
    remove_action( 'homepage', 'storefront_on_sale_products',      60 );
    remove_action( 'homepage', 'storefront_best_selling_products', 70 );
};

add_action( 'wp_head', 'remove_homepage_hooks' );
 /*
 inc/storefront-template-functions.php
 */

 if ( ! function_exists( 'storefront_featured_products' ) ) {
 	/**
 	 * Display Featured Products
 	 * Hooked into the `homepage` action in the homepage template
 	 *
 	 * @since  1.0.0
 	 * @param array $args the product section args.
 	 * @return void
 	 */
 	function storefront_featured_products( $args ) {

 		if ( storefront_is_woocommerce_activated() ) {

 			$args = apply_filters( 'storefront_featured_products_args', array(
 				'limit'   => 3,
 				'columns' => 3,
 				'orderby' => 'date',
 				'order'   => 'desc',
 				'title'   => __( '<i class="fa fa-thermometer-three-quarters"></i> Hot &amp; Fresh <i class="fa fa-hand-spock-o"></i>', 'storefront' ),
 			) );

 			echo '<section class="storefront-product-section storefront-featured-products" aria-label="Featured Products">';

 			do_action( 'storefront_homepage_before_featured_products' );

 			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

 			do_action( 'storefront_homepage_after_featured_products_title' );

 			echo storefront_do_shortcode( 'featured_products', array(
 				'per_page' => intval( $args['limit'] ),
 				'columns'  => intval( $args['columns'] ),
 				'orderby'  => esc_attr( $args['orderby'] ),
 				'order'    => esc_attr( $args['order'] ),
 			) );

 			do_action( 'storefront_homepage_after_featured_products' );

 			echo '</section>';
 		}
 	}
 }

 function get_footer_hero() {
     if (is_single() ) {?>
     <section class="hero">
        <div class="wrap">
            <h1>
                <span>The hues Store</span> is merch created by (and supporting the work of) <span>Sam Killermann</span> + <span>Friends</span>
            </h1>
        </div>
        <ul class="wrap">
            <li>
                <a href="" class="button">Become a Member</a>
                <span><a href="" alt="">View benefits</a></span>
            </li>
            <li>
                <a href="" class="button button-secondary">Join Mailing List</a>
            </li>
        </ul>

     </section>
<?php } }

 add_action('storefront_before_footer','get_footer_hero');

function get_about_list() {?>
    <section class="faq-list wrap">
        <h3 class="pink">
            <i class="fa fa-user"></i>
            <span>Title</span>
        </h3>
        <p class="pink">
            This is the explanation of the title. Let's do this!
        </p>
    </section>
<?php }

 // Remove "Storefront Designed by WooThemes" from Footer

 add_action( 'init', 'custom_remove_footer_credit', 10 );
 function custom_remove_footer_credit () {
     remove_action( 'storefront_footer', 'storefront_credit', 20 );
     add_action( 'storefront_after_footer', 'custom_storefront_credit', 20 );
 }

 function custom_storefront_credit() {
     ?>
    <div class="site-info wrap">
        <p>
            Uncopyright <del>&copy;</del> <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>. Proudly built with <a href="http://woocommerce.com" target="_blank">WooCommerce</a> &amp; <a href="https://woocommerce.com/storefront/" target="_blank">Storefront</a> (<a href="https://medium.com/startup-grind/shopify-is-now-the-single-largest-source-of-revenue-for-steve-bannons-breitbart-8de8106b262e#.vwe339ukn" target="_blank">#DeleteShopify</a>),
            fulfilled by <a href="http://printful.com" target="_blank">Printful</a> &amp; hosted with <a href="http://pressable.com" target="_blank">Pressable</a>,
            and based in sunny Austin, TX.
        </p>
        <p>
            The hues Store<br/>
            P.O. Box 684412<br/>
            Austin, TX 78768<br/>
        </p>
    </div><!-- .site-info -->
    <?php
 }

// Adding Buttons to Products
function add_buttons_to_products() {?>
    <div class="fb-save" data-uri="<?php global $wp; $current_url = home_url(add_query_arg(array(),$wp->request));?>" data-size="large"></div>ASDF
    <?php
}

add_action('storefront_post_content_before','add_buttons_to_products', 100);
