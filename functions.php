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

add_post_type_support( 'page', 'excerpt' );

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

// Make Gallery Thumbs Full Size Quality

 add_filter( 'woocommerce_gallery_image_size', function( $size ) {
     return 'full';
 } );

// REMOVE DEFAULT GOOGLE FONTS
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

    // unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function remove_pgz_theme_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'remove_pgz_theme_support', 100 );

// Custom Admin Styles

function hues_login_css() {
	wp_enqueue_style( 'hues_login_css', get_stylesheet_directory_uri() . '/login.css', false );
}

// changing the logo link from wordpress.org to your site
function hues_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function hues_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'hues_login_css', 10 );
add_filter('login_headerurl', 'hues_login_url');
add_filter('login_headertitle', 'hues_login_title');


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
 				'title'   => __( '<i class="far fa fa-thermometer-three-quarters"></i> Hot &amp; Fresh <i class="far fa fa-hand-spock-o"></i>', 'storefront' ),
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
                <a href="https://hues.xyz/members" title="Become a member and get exclusive stuff" class="button">Become a Member</a>
                <span><a href="https://hues.xyz/members/#benefits" title="View Membership Benefits">View benefits</a></span>
            </li>
            <li>
                <a href="https://hues.xyz/#MailingList" class="button button-secondary">Join Mailing List</a>
            </li>
        </ul>

     </section>
<?php } }

add_action('storefront_before_footer','get_footer_hero');

function get_about_list() {?>
    <section class="faq-list wrap">
        <div class="faq light-orange">
            <h3 aria-hidden="true">
                <i class="far fa fa-truck"></i>
            </h3>
            <p>
                <strong>Free US Shipping on orders over $50.</strong> Don't like paying for shipping? Neither do I. It's a principles thing.
            </p>
        </div>
        <div class="faq pink">
            <h3 aria-hidden="true">
                <i class="far fa fa-recycle"></i>
            </h3>
            <p>
                <strong>Ethical, sustainable, sweatshop-free supply chain.</strong> From the sourcing of the cotton to the final printing, everything is on the up-and-up, with carbon offsetting to boot.
            </p>
        </div>
        <div class="light-blue faq">
            <h3 aria-hidden="true">
                <i class="fa fab fa-cc-paypal"></i>
            </h3>
            <p>
                <strong>PayPal &amp; all major credit cards accepted.</strong> Don't want to make <em>another</em> account? No need. Check out in a breeze with safe, secure, forever-trusted PayPal.
            </p>
        </div>
        <div class="teal faq">
            <h3 aria-hidden="true">
                <i class="fab fa fa-rebel"></i>
            </h3>
            <p>
                <strong>Indepently run, supporting social justice.</strong> This is a one-person rebellion, and any money raised here supports my work that reaches hundreds of millions of people around the world.
            </p>
        </div>
    </section>
<?php }

function loop_child_pages() {
    if (is_page()) {

        global $post;

        $args = array(
            'post_parent' => $post->ID,
            'post_type' => 'page',
            'orderby' => 'menu_order'
        );

        $child_query = new WP_Query( $args );

        echo '<div class="loop">';

        while ( $child_query->have_posts() ) : $child_query->the_post(); ?>

            <a <?php post_class('card'); ?> href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                <h3><?php the_title(); ?></h3>
                <?php the_excerpt(); ?>
            </a>
        <?php endwhile; ?>

        <?php
        wp_reset_postdata();

        echo '</div>';
    }

}

add_action ('storefront_before_footer', 'loop_child_pages');

// Below Header Message

function get_store_primer() {?>
    <div class="mobileHide">
        <ul id="storePrimer">
            <li class="light-orange">
                <i class="far fa fa-fw fa-truck fa-pull-right fa-2x"></i>
                <strong>Free US Shipping</strong>
                <span>on orders over $50</span>
            </li>
            <li class="pink">
                <i class="far fa fa-fw fa-recycle fa-pull-right fa-2x"></i>
                <strong>Ethical &amp; Sustainable</strong>
                <span>sweatshop-free supply chain</span>
            </li>
            <li class="light-blue">
                <i class="fab fa fa-fw fa-cc-paypal fa-pull-right fa-2x"></i>
                <strong>PayPal Accepted</strong>
                <span>+ all major credit cards</span>
            </li>
            <li class="teal">
                <i class="far fa fa-fw fa-rebel fa-pull-right fa-2x"></i>
                <strong>Indepently Run</strong>
                <span>supporting social justice</span>
            </li>
        </ul>
    </div><!--/mobileHide-->
<?php }

add_action ('storefront_before_content','get_store_primer');

// Remove "Storefront Designed by WooThemes" from Footer

add_action( 'init', 'custom_remove_footer_credit', 10 );
function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
}

// Limit Members Only WooCommerce Category to Patreon Patrons

function restrict_members_only_products_to_patrons() {

    // set the slug of the category for which we disallow checkout
	$category = 'members-only';

    // get the product category
	$product_cat = get_term_by( 'slug', $category, 'product_cat' );

    // sanity check to prevent fatals if the term doesn't exist
	if ( is_wp_error( $product_cat ) ) {
		return;
	}

	// check if this category is the only thing in the cart
	if ( check_if_user_is_not_patron() ) {

        if ( is_category_in_cart( $category ) ) {

    		// render a notice to explain why checkout is blocked
    		wc_add_notice( sprintf( 'Hi there! Looks like your cart contains something that is only for members. You can sign up to be a member right now on <a href="https://patreon.com/killermann" title="Become a member on Patreon">Patreon</a> and we will be all set, otherwise you will need to remove that item from your cart to check out.'), 'error' );
        }
	}
}

function check_if_user_is_not_patron() {

    $user_patronage = Patreon_Wordpress::getUserPatronage();

    if ( $user_patronage >= 1 ) {
		return false;
	}

    return true;
}

function is_category_in_cart($category) {
    // check each cart item for our category
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

        // if a product is not in our category, bail out since we know the category is not alone
        if ( has_term( $category, 'product_cat', $cart_item['data']->id ) ) {
            return true;
        }
    }
}

add_action( 'woocommerce_check_cart_items', 'restrict_members_only_products_to_patrons' );

/**
 * Allow HTML in term (category, tag) descriptions
 */
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}

foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}
?>
