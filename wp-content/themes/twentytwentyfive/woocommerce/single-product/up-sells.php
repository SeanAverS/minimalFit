<?php
/**
 * Single Product Up-Sells Override 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'Same But Different', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h3><?php echo esc_html( $heading ); ?></h3>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				// Dont show "add to cart" button 
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				// Render section 
				wc_get_template_part( 'content', 'product' );
				// Turn button back on for rest of site
				add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

	<?php
endif;

wp_reset_postdata();
