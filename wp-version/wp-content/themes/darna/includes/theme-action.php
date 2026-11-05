<?php
/*---------------------------------------------------
/* THEME URL REWRITE
/*---------------------------------------------------*/
if (!function_exists('g5plus_less_css_url_rewrite')) {
	function g5plus_less_css_url_rewrite() {
		$my_theme = get_stylesheet();
		add_rewrite_rule( 'wp-content/themes/' . $my_theme . '/g5plus-less-css', 'index.php', 'top' );
		flush_rewrite_rules();
	}
	add_action( 'init', 'g5plus_less_css_url_rewrite', 1);
}

// ADD HEADER CUSTOMIZE CSS
//--------------------------------------------------
if (!function_exists('g5plus_enqueue_header_custom_style')) {
	function g5plus_enqueue_header_custom_style() {
		if (is_singular()) {
			/*echo sprintf('<link rel="stylesheet" type="text/css" media="all" href="%sg5plus-less-css?custom-page=header-custom-css&amp;current_page_id=%d"/>',
				THEME_URL,
				get_the_ID()
				);*/
			echo sprintf('<link rel="stylesheet" type="text/css" media="all" href="%s?action=header-custom-css&amp;current_page_id=%d"/>',
				admin_url( 'admin-ajax.php' ),
				get_the_ID()
			);
		}
	}
	add_action('wp_head', 'g5plus_enqueue_header_custom_style',100);
}

/*---------------------------------------------------
/* REMOVE ACTION
/*---------------------------------------------------*/
remove_action('g5plus_after_single_post_content','g5plus_share',15);
remove_action('g5plus_after_single_post_content','g5plus_post_tags',10);
remove_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_category',1);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',16);

