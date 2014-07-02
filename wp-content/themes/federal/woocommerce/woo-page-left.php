<div class="col-md-3">
	<aside class="sidebar-nav">
		<ul>
			<li>
				<?php if(is_active_sidebar('shop-sidebar')) dynamic_sidebar('shop-sidebar'); ?>
			</li>
		</ul>
	</aside>
</div>
<div class="col-md-9">
	<?php woocommerce_content(); ?>
</div>