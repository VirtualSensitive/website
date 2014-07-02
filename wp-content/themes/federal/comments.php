<?php
$rb_comment_form_args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'POST A COMMENT','rb'),
  'title_reply_to'    => __( 'Post a Comment to %s', 'rb'),
  'cancel_reply_link' => __( 'Cancel Reply', 'rb'),
  'label_submit'      => __( 'Post Comment', 'rb'),

  'comment_field' =>  '<div id="comment-textarea" class="instant-message"><label for="comment">' . __('Your Messages','rb') .
	'<span class="font-color font-raleway"> '.__('Required', 'rb').' </span>'.
    '</label><textarea class="textarea-comment" id="comment" name="comment" cols="39" rows="4" aria-required="true" placeholder="'.__('Comment...', 'rb').'">' .
    '</textarea></div>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.', 'rb'),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="nolink" title="Log out of this account">Log out?</a>', 'rb'),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div id="comment-input" class="row">' .
	  '<div class="input col-lg-4 col-md-12 col-xs-12">'.
      '<label for="author">' . __( 'Name', 'rb') . '</label> ' .
      ( $req ? ': <span class="font-color font-raleway"> '.__('Required','rb').' </span>' : '' ) .
      '<input class="input-name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"  placeholder="'.__( 'Name (required)', 'rb' ).'" /></div>',

    'email' =>
	  '<div class="input col-lg-4 col-md-12 col-xs-12">'.
      '<label for="email">' . __( 'Email', 'rb' ) . '</label> ' .
      ( $req ? ': <span class="font-color font-raleway"> '.__('Required','rb').' </span>' : '' ) .
      '<input class="input-email" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" placeholder="'.__( 'Email (required)', 'rb' ).'" /></div>',

    'url' =>
	  '<div class="input col-lg-4 col-md-12 col-xs-12">'.
      '<label for="url">' .
      __( 'Website', 'rb' ) . '</label>' .
      '<input class="input-website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" placeholder="'.__( 'Website', 'rb' ).'" /></div></div>'
    )
  ),
);


function rb_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="the-comment">
		<?php endif; ?>
		<div class="avatar">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
	<?php if ($comment->comment_approved == '0') { ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'rb') ?></em>
		<br />
	<?php }else{ ?>
		<div class="comment-box">
			<div class="comment-author meta">
				<h5><?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?></h5>
				<div class="author-date"><?php
					echo get_comment_date();?> <?php edit_comment_link(__('(Edit)', 'rb'),'  ','' );
				?></div>
			</div>
			
			<div class="comment-content"><?php comment_text() ?></div>
			
			<div class="right"><?php comment_reply_link(array('reply_text'=>__('Reply &raquo;','rb'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])) ?></div>
		</div><!-- .comment-text --> 
    <?php
        }
	?>
		<?php if ( 'div' != $args['style'] ) { ?>
		</div>
	<?php } 
}

	
	
function get_comment_nav()
{
?>
	<?php if(get_comment_pages_count()> 1){?>
	<div class="comments-nav">
		<div class="prev">
			<?php previous_comments_link(__('Prev Comments','rb')); ?>
		</div>
		<div class="next">
			<?php next_comments_link(__('Next Comments','rb')); ?>
		</div>
	</div>
	<?php }
}
?>

<!-- BEGIN: comments -->
<div id="comments" class="comments-area">
<?php if(have_comments()){ ?>
	<h3 id="comments-title">
		<?php echo __(' COMMENTS','rb').' ('.get_comments_number().')'; ?>
	</h3>
	
	<?php get_comment_nav();?>
	
	<ol class="commentlist">
		<?php wp_list_comments(array('type'=>'comment', 'callback'=>'rb_comment', 'avatar_size'=>80)); ?>
    </ol>
	
	<div class="clearfix"></div>
	
	<?php get_comment_nav();?>
	
	<?php if(comments_open()){ comment_form($rb_comment_form_args); } ?>
	
<?php }elseif(!comments_open()){ ?>
	
<?php }else{ ?>
	<?php comment_form($rb_comment_form_args); ?>
<?php } ?>
</div>
<!-- END: comments -->