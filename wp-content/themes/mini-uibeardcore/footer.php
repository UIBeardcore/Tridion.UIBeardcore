<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
       
        <?php /* ?>
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
        <?php */ ?>
        
	    <?php if ( is_active_sidebar( 'foobar-0' ) ) : ?>
		    <div id="footer-secondary" class="footer-widget-area" role="complementary">
			    <?php dynamic_sidebar( 'foobar-0' ); ?>
		    </div><!-- #secondary -->
	    <?php endif; ?>
	</footer><!-- #colophon -->

</div><!-- #page -->    

<?php wp_footer(); ?>
</body>
</html>