<?php
/**
 * storefront engine room
 *
 * @package storefront-child
 */


add_action('after_setup_theme', 'override_parent_theme_features', 10);

function override_parent_theme_features() {
    remove_action( 'storefront_header', 'storefront_social_icons', 10);
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30);
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    add_action( 'storefront_header', 'storefront_product_search', 30);
    add_action( 'storefront_header', 'storefront_header_cart', 40 );

    if ( !is_home() ) {
        remove_action( 'storefront_page', 'storefront_page_header', 10 );
remove_action( 'homepage', 'storefront_product_categories',	20 );
remove_action( 'homepage', 'storefront_recent_products',		30 );
remove_action( 'homepage', 'storefront_featured_products',		40 );
remove_action( 'homepage', 'storefront_popular_products',		50 );
remove_action( 'homepage', 'storefront_on_sale_products',		60 );
    }


    add_action( 'storefront_footer', 'storefront_secondary_navigation',
        5 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
}

if (!function_exists('Storefront_Designer')) {
    function Storefront_Designer() {
        set_theme_mod('sd_header_layout', 'expanded' );
    }
}

function storefront_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
		</div><!-- .site-info -->
		<?php
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}