<?php
register_sidebar(array(
			'name' => 'Shop Sidebar',
			'id' => 'shop-sidebar',
			'description' => 'These shows up on shop page' ,
			'before_title' => '<div class="wtitle-container"><h3 class="first-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="shop-sidebar-container %2$s">',
			'after_widget' => '</div>',
		));
		
		
register_sidebar(array(
			'name' => 'First Widget Area',
			'id' => 'first-general-wa',
			'description' => 'Before all widgets and show all pages' ,
			'before_title' => '<div class="wtitle-container"><h3 class="first-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="first-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array(
			'name' => 'Right Widget Area',
			'id' => 'right-general-wa',
			'description' => 'Show only rigth sidebar' ,
			'before_title' => '<div class="wtitle-container"><h3 class="first-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="first-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array(
			'name' => 'Left Widget Area',
			'id' => 'left-general-wa',
			'description' => 'Show only left sidebar' ,
			'before_title' => '<div class="wtitle-container"><h3 class="first-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="first-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Last Widget Area',
			'id' => 'last-general-wa',
			'description' => 'After all widgets and show all pages' ,
			'before_title' => '<div class="wtitle-container"><h3 class="last-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="last-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Front Page Widget Area',
			'id' => 'font-page-wa',
			'description' => 'Front Page Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="front-page-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="front-page-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Single Page Widget Area',
			'id' => 'single-wa',
			'description' => 'Single Page Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="single-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="single-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Page Widget Area',
			'id' => 'page-wa',
			'description' => 'Page Page Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="page-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="page-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Category Widget Area',
			'id' => 'category-wa',
			'description' => 'Category Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="category-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="category-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Tag Widget Area',
			'id' => 'tag-wa',
			'description' => 'Tag Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="tag-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="tag-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Author Widget Area',
			'id' => 'author-wa',
			'description' => 'Author Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="author-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="author-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Date Widget Area',
			'id' => 'author-wa',
			'description' => 'Author Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="author-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="author-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Archive Widget Area',
			'id' => 'archive-wa',
			'description' => 'Archive Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="archive-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="archive-wa-container %2$s">',
			'after_widget' => '</div>',
		));
register_sidebar(array('name' => 'Search Widget Area',
			'id' => 'search-wa',
			'description' => 'Search Widget Area' ,
			'before_title' => '<div class="wtitle-container"><h3 class="search-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="search-wa-container %2$s">',
			'after_widget' => '</div>',
		));
		
$rb_footerColumns = (int) get_option('footerColumns', '4');
for($rb_fc=1; $rb_fc<=$rb_footerColumns; $rb_fc++){
	register_sidebar(array('name' => 'Footer Widget Area #'.$rb_fc,
			'id' => 'footer-wa-'.$rb_fc,
			'description' => 'Footer Widget Area #'.$rb_fc ,
			'before_title' => '<div class="wtitle-container"><h3 class="footer-wa">',
			'after_title' => '</h3></div>',		
			'before_widget' => '<div id="%1$s" class="footer-wa-container %2$s">',
			'after_widget' => '</div>',
		));
}

?>