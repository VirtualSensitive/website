<?php
function rb_woocommerce_actions(){
	add_theme_support( 'woocommerce' );
	
	add_image_size( 'rb_shop_size', 356, 464, true );
	add_image_size( 'rb_shop_large_size', 690, 900, true );
	add_image_size( 'rb_shop_thumbnail_size', 207, 207, true );
	
	
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			 
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );

	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	
	// Change Defaults
	add_filter( 'loop_shop_per_page', 'rb_loop_shop_per_page');
	add_filter( 'loop_shop_columns',  'rb_loop_shop_columns');
	add_filter( 'woocommerce_show_page_title', 'rb_woocommerce_show_page_title');
	add_filter( 'woocommerce_product_review_comment_form_args', 'rb_product_review_form');
	add_filter( 'single_product_small_thumbnail_size', 'rb_single_product_small_thumbnail_size');
	add_filter( 'single_product_large_thumbnail_size', 'rb_single_product_large_thumbnail_size');
	
	// Additional Actions
	// change product thumbnail
	add_action('woocommerce_before_shop_loop_item_title', 'rb_product_thumbnail', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	
	add_action( 'wp_enqueue_scripts', 'rb_custom_woocommerce_scripts', 9 );
	add_action( 'wp_enqueue_scripts', 'rb_change_prettyPhoto', 10 );
}

function rb_custom_woocommerce_scripts(){
	wp_dequeue_script( 'wc-single-product' );
	wp_dequeue_script( 'wc-add-to-cart' );
	
    wp_enqueue_script( 'wc-single-product', get_stylesheet_directory_uri() . '/woocommerce/assets/js/frontend/single-product.js', array( 'jquery' ), WC_VERSION, true );
    wp_enqueue_script( 'wc-add-to-cart', get_stylesheet_directory_uri() . '/woocommerce/assets/js/frontend/add-to-cart.js', array( 'jquery' ), WC_VERSION, true );
}

function rb_change_prettyPhoto(){
	wp_dequeue_script( 'prettyPhoto-init' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	
	$lightbox_en          = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;
	global $post;
	if ( $lightbox_en && ( is_product() || ( ! empty( $post->post_content ) && strstr( $post->post_content, '[product_page' ) ) ) ) {
		wp_enqueue_script( 'prettyPhoto-init', get_stylesheet_directory_uri() . '/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.js', array( 'jquery' ), WC_VERSION, true );
		wp_enqueue_style( 'woocommerce_prettyPhoto_css', get_stylesheet_directory_uri() . '/woocommerce/assets/css/prettyPhoto.css');
	}
}


/* Defaults */
function rb_woocommerce_show_page_title(){ return false; }
function rb_loop_shop_per_page(){ return 9; }
function rb_loop_shop_columns(){
	if(is_product())
		return 5; 
	else
		return 3;
}
function rb_single_product_small_thumbnail_size(){ return 'rb_shop_thumbnail_size';}
function rb_single_product_large_thumbnail_size(){ return 'rb_shop_large_size';}
function woocommerce_upsell_display( $posts_per_page = 6, $columns = 3, $orderby = 'rand' ) {
	woocommerce_get_template( 'single-product/up-sells.php', array(
		'posts_per_page' => $posts_per_page,
		'orderby' => $orderby,
		'columns' => $columns
	) );
}

function woocommerce_output_related_products() {
	$args = array(
		'posts_per_page' => 6,
		'columns' => 3,
		'orderby' => 'rand'
	);
	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

// Addition Actions
function rb_product_thumbnail()
{
	global $product;
	$rating = $product->get_rating_html();
	$size = 'rb_shop_size';
	echo "<div class='thumbnail-wrapper'>";
		echo rb_product_second_thumb( get_the_ID() , $size);
		echo get_the_post_thumbnail( get_the_ID() , $size );
		if($product->product_type == 'simple') echo "<span class='cart-loading'></span>";
		echo '<div class="thumbnail-fg"></div>';
		echo '<div class="zubeyr-v"></div><div class="zubeyr-h"></div>';
		echo $product->get_rating_html();
	echo "</div>";
}


function rb_product_second_thumb($productID, $imageSize)
{
	$pGallery = get_post_meta( $productID, '_product_image_gallery', true );
	if(!empty($pGallery))
	{
		$images		= explode(',',$pGallery);
		$imageID 	= (int) $images[0];
		if($imageID>0){
			$image = wp_get_attachment_image( $imageID, $imageSize, false, array( 'class' => 'attachment-'.$imageSize.' thumbnail-second' ));
			if(!empty($image)) return $image;
		}
	}
}

// Additional Functions
function rb_woocommerce_catalog_ordering(){
	$catalog_ordering['menu_order'] 		= __("Default sorting",'rb');
	$catalog_ordering['popularity'] 		= __("Sort by popularity",'rb');
	$catalog_ordering['rating'] 			= __("Sort by average rating",'rb');
	$catalog_ordering['date'] 				= __("Sort by newness",'rb');
	$catalog_ordering['price']				= __("Sort by price: low to high",'rb');
	$catalog_ordering['price-desc']			= __("Sort by price: high to low",'rb');
	
	if(isset($_GET['orderby'])) $selectedOrder = esc_attr($_GET['orderby']);
	$selectedOrder = (empty($selectedOrder))? get_option( 'woocommerce_default_catalog_orderby' ) : $selectedOrder;
	
	$re = '';
	$re .= '<ul class="rb_woo_order">';
	$re .= '<li>';
	$re .= '<span class="current">'.$catalog_ordering[$selectedOrder].' <span class="arrow"></span></span>';
	$re .= '<ul>';
	foreach($catalog_ordering as $order_val => $order_text){
		if($selectedOrder==$order_val)
			$re .= '<li class="current">';
		else
			$re .= '<li>';
		$re .= '<a rel="nofollow" href="?orderby='.$order_val.'">'.$order_text.'</a>';
		$re .= '</li>';
	}
	$re .= '</ul>';
	$re .= '</li>';
	$re .= '</ul>';
	echo $re;
}

function rb_product_review_form(){
	$commenter = wp_get_current_commenter();
	$comment_form = array(
		'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
		'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'label_submit'  => __( 'Submit', 'woocommerce' ),
		'logged_in_as'  => '',
		'comment_field' => ''
	);
	
	if(!is_user_logged_in()){
		$comment_form['fields'] = array(
			'author' => '<div class="row"><div class="col-md-6"><p class="comment-form-author">'.
						'<input id="author" placeholder="'.__( 'Name', 'woocommerce' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email">' .
						'<input id="email" name="email" type="text" placeholder="'.__( 'Email', 'woocommerce' ).'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		);
	}
	
	if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
		$comment_form['comment_field'] .= '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
			<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
			<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
			<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
			<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
			<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
			<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
		</select></p>';
		if(!is_user_logged_in())
			$comment_form['comment_field'] .= '</div>';
	}elseif(!is_user_logged_in())
		$comment_form['comment_field'] .= '</div>';

	$comment_form['comment_field'] .= '<div class="col-md-6"><p class="comment-form-comment"><textarea placeholder="'.__( 'Your Review', 'woocommerce' ).'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>';
	if(!is_user_logged_in())
		$comment_form['comment_field'] .= '</div>';
	return $comment_form;
}

?>