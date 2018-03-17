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
		<section id="hero">
			<div class="wrap">
				<h1>
					<span>The hues Store</span> is merch created by (and supporting the work of) <span>Sam Killermann</span> + <span>Friends</span>
				</h1>
			</div>
		</section>
		<section id="hero-cta">
			<div id="hero-cta--inner">
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
					<form action="https://samkillermann.us3.list-manage.com/subscribe/post?u=b0497ab27b695ca0aa9c4787e&amp;id=a2529d5c19" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate grid grid--center grid--fit" target="_blank" novalidate>

						<input type="email" value="" placeholder="Enter your Email" name="EMAIL" class="required email" id="mce-EMAIL">

						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b0497ab27b695ca0aa9c4787e_a2529d5c19" tabindex="-1" value=""></div>
					   <button type="submit" value="Yes, please." name="subscribe" id="mc-embedded-subscribe" class="button">
						  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <i class="fa fa-lemon-o" aria-hidden="true"></i>
					   </button>
					</form>
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

			<section class="showcase term-heretic-podcast">
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
			</section>
		</main><!-- #main -->

	</div><!-- #primary -->
<?php
get_footer();
