<?php get_header(); ?>
<?php 
$rb_woo_title ='';

if(is_product_category() || is_product_tag()){
    $rb_woo_title = single_term_title('',false); // category, tag pages, search, shorts
}elseif(is_product()){
   $rb_woo_title =  get_the_title(get_the_ID()); //product page
}else{
    $rb_woo_title =  get_the_title(get_option('woocommerce_shop_page_id')); // shop page
}

$rb_woo_sidebar = strtolower(get_option('sidebarWooCommerceDefault','left'));
$rb_woo_product_sidebar = strtolower(get_option('sidebarWooCommerceProduct','left'));
?>
<section class="pageSection">
	<article class="container speacing-box-element">
		<header>
			<div class="heading text-center">
				<h2><?php echo $rb_woo_title; ?></h2>
			</div>
			<?php if(!is_product()): ?>
			<div class="text-center"><?php rb_woocommerce_catalog_ordering(); ?></div>
			<?php endif; ?>
		</header>
		<div class="row block-content">
			
			<?php
			if(is_product())
				get_template_part( 'woocommerce/woo-page', $rb_woo_product_sidebar ); 
			else
				get_template_part( 'woocommerce/woo-page', $rb_woo_sidebar ); 
			?>
			
		</div><!-- .row -->
	</article>
</section>
<?php get_footer(); ?>