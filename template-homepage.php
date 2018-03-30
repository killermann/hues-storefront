<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section class="hero">
			<div class="wrap">
				<h1>
					<span>The hues Store</span> is merch created by (and supporting the work of) <span>Sam Killermann</span> + <span>Friends</span>
				</h1>
			</div>
		</section>
		<section class="hero-cta">
			<div class="hero-cta--inner">
				<div class="hero-cta--inner--wrap">
					<h2>Hi! Welcome to my lemonade stand.</h2>
					<p>
						<a href="" alt="">Sam here</a>. I'm thrilled you've come by! I built this little shop in March 2018 to make it easier for people to find <a href="">all the things I'm making</a> in one spot, and to <a href="patrons" alt="">give back to the wonderful humans who become my patrons</a> throughout the year.
					</p>
				</div>
				<div class="hero-cta--inner--wrap">
					<p>
						<big>Sign up for the hues Store newsletter <i class="fa fa-level-down" aria-hidden="true"></i> and I'll happily give you free shipping on your first order </big>
					</p>
					<script async id="_ck_364687" src="https://forms.convertkit.com/364687?v=7"></script>
				</div>
			</div>
		</section>

		<main id="main" class="site-main" role="main">

			<?php
			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
			do_action( 'homepage' ); ?>

			<!-- <section class="showcase term-heretic-podcast">
				<div class="wrap">
					<h2>Heretic Podcast Merch</h2>
					<p class="section-description">
						Buy things to support IPM
					</p>
					<?php echo do_shortcode('[products limit="5" columns="5"]');?>
				</div>
			</section>
			<section class="showcase term-its-pronounced-metrosexual">
				<div class="wrap">
					<h2>It's Pronounced Metrosexual Merch</h2>
					<p class="section-description">
						Buy things to support IPM
					</p>
					<?php echo do_shortcode('[products limit="4" columns="4" category="its-pronounced-metrosexual"]');?>
				</div>
			</section>
			<section class="showcase term-safe-zone-project">
				<div class="wrap">
					<h2>The Save Zone Project Merch</h2>
					<div class="showcase--inner">
						<?php echo do_shortcode('[products limit="4" columns="4"]');?>
					</div>
				</div>
			</section>
			<section class="showcase term-impetus-books">
				<div class="wrap">
					<h2>Impetus Books Merch</h2>
					<p class="section-description">
						Reading books is cool. Telling people you read books is cooler.
					</p>
					<div class="showcase--inner">
						<?php echo do_shortcode('[products limit="4" columns="4"]');?>
					</div>
				</div>
			</section>
			<section id="sk" class="showcase">
				<div class="wrap">
					<h2>Sam Killermann Merch</h2>
					<div class="showcase--inner">
						<?php echo do_shortcode('[products limit="5" columns="5"]');?>
					</div>
				</div>
			</section>
			<section id="sk" class="showcase">
				<div class="wrap">
					<h2>Impetus Books Merch</h2>
					<div class="showcase--inner">
						<?php echo do_shortcode('[products limit="4" columns="2"]');?>
					</div>
				</div>
			</section> -->
		</main><!-- #main -->

	</div><!-- #primary -->
<?php
get_footer();
