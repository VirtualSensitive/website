<?php if (!have_posts()) : ?>
	<div class="alert alert-warning"><?php _e('Sorry, no results were found.', 'rb'); ?></div>
	<?php get_search_form(); ?>	
<?php endif; ?>

<?php while (have_posts()) : the_post();  ?>
		<?php get_template_part( 'templates/loop', 'post' ); ?>
<?php endwhile; // End the loop ?>

<?php echo rb_get_pagination(); ?> 