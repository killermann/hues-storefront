<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->
<div id="huesBar" class="clearfix" style="background:#222; font-family:sans-serif;padding:3px 12px">
	<div class="fb-like" style="float:right;margin:0px 0 0 12px" data-href="https://www.facebook.com/healthyunderstoodeducatedsafe/" data-width="140" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
	<p style="margin:14px; line-height:1.1; font-size:14px; color:rgba(255,255,255,.5); text-align:right;">
		This project is part of <em style="font-family:georgia,serif;"><a style="text-decoration:none;" href="http://hues.xyz" alt="hues Global Justice Collective"><span style="color:#f5a81c">h</span><span style="color:#e81d76">u</span><span style="color:#42b4e3">e</span><span style="color:#00a897">s</span></a></em>, a global justice collective

	</p>
</div>


<?php wp_footer(); ?>

</body>
</html>
