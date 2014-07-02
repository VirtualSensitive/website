<?php  $searchQuery = get_search_query(); ?>
<div class="form-search">
	<form id="searchform" action="<?php echo home_url(); ?>" method="get">
		<input class="searchbox" name="s" type="text" placeholder="Search" value="<?php the_search_query(); ?>">
		<input type="hidden" name="post_type" value="product" />
		<button  type="button" >
			<span class="fa fa-search"></span>
		</button>
	</form>
</div>