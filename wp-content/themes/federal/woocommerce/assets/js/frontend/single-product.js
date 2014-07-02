jQuery( function( $ ) {
	// wc_single_product_params is required to continue, ensure the object exists
	if ( typeof wc_single_product_params === 'undefined' ) {
		return false;
	}

	// Tabs
	$( '.woocommerce-tabs .panel' ).hide();

	$( '.woocommerce-tabs ul.tabs li a' ).click( function() {

		var $tab = $( this ),
			$tabs_wrapper = $tab.closest( '.woocommerce-tabs' );

		$( 'ul.tabs li', $tabs_wrapper ).removeClass( 'active' );
		$( 'div.panel', $tabs_wrapper ).hide();
		$( 'div' + $tab.attr( 'href' ), $tabs_wrapper).show();
		$tab.parent().addClass( 'active' );

		return false;
	});

	$( '.woocommerce-tabs' ).each( function() {
		var hash	= window.location.hash,
			url		= window.location.href,
			tabs	= $( this );

		if ( hash.toLowerCase().indexOf( "comment-" ) >= 0 ) {
			$('ul.tabs li.reviews_tab a', tabs ).click();

		} else if ( url.indexOf( "comment-page-" ) > 0 || url.indexOf( "cpage=" ) > 0 ) {
			$( 'ul.tabs li.reviews_tab a', $( this ) ).click();

		} else {
			$( 'ul.tabs li:first a', tabs ).click();
		}
	});

	$( 'a.woocommerce-review-link' ).click( function() {
		$( '.reviews_tab a' ).click();
		return true;
	});

	$('#comments > h2').hide();
	
	// Star ratings for comments -- start rutine changed
	$( '#rating' ).hide().before( '<p class="rb-stars"><a class="rb-star-item">1</a><a class="rb-star-item">2</a><a class="rb-star-item">3</a><a class="rb-star-item">4</a><a class="rb-star-item">5</a></p>');
	$( 'body' )
		.on( 'mouseover', '#respond .rb-star-item', function(){
			var $star 	= $( this );
			$star.addClass('rb-star-active');
			$star.prevAll().addClass('rb-star-active');
			$star.nextAll().removeClass('rb-star-active');
		})
		.on( 'mouseout', '#respond .rb-stars', function(){
			var $stars 	= $( this );
			if($stars.find('a.active').length==0)
				$stars.find('a').removeClass('rb-star-active');
			else{
				$stars.find('a.active').addClass('rb-star-active');
				$stars.find('a.active').prevAll().addClass('rb-star-active')
				$stars.find('a.active').nextAll().removeClass('rb-star-active');
			}
		})
		.on( 'click', '#respond .rb-star-item', function() {
			var $star   = $( this ),
				$rating = $( this ).closest( '#respond' ).find( '#rating' );

			$rating.val( $star.text() );
			$star.siblings( 'a' ).removeClass( 'active' );
			$star.addClass( 'active' );

			return false;
		})
		.on( 'click', '#respond #submit', function() {
			var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
				rating  = $rating.val();

			if ( $rating.size() > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
				alert( wc_single_product_params.i18n_required_rating_text );

				return false;
			}
		});

	// prevent double form submission
	$( 'form.cart' ).submit( function() {
		$( this ).find( ':submit' ).attr( 'disabled','disabled' );
	});
});