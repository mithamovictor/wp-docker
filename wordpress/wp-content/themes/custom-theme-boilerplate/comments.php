<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

require_once 'inc/comments-walker.php';

if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area"><?php

	// You can start editing here -- including this comment!

	if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments</h2>
		<ol class="commentlist"><?php
			wp_list_comments(
				array(
					// 'callback' => 'theme_comment',
					'walker' => new comment_walker(),
					'style'    => 'ol',
				)
			); ?>
		</ol><?php // .commentlist

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div id="comment-nav-below" class="comments" role="comments">
				<h1 class="assistive-text section-heading"><?php
					_e( 'Comment navigation', 'theme' ); ?>
				</h1>
				<div class="nav-previous"><?php
					previous_comments_link( __( '&larr; Older Comments', 'theme' ) ); ?>
				</div>
				<div class="nav-next"><?php
					next_comments_link( __( 'Newer Comments &rarr;', 'theme' ) ); ?>
				</div>
			</div><?php
		endif; // check for comment navigation

		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'theme' ); ?></p><?php
		endif;
	endif; // have_comments()

	comment_form (
		array(
			'id_form'           => 'commentform',
			'class_form'        => 'comment-form',
			'id_submit'         => 'submit',
			'class_submit'      => 'submit',
			'name_submit'       => 'submit',
			'title_reply'       => __( 'Leave a Reply' ),
			'title_reply_to'    => __( 'Leave a Reply to %s' ),
			'cancel_reply_link' => __( 'Cancel Reply' ),
			'label_submit'      => __( 'Post Comment' ),
			'format'            => 'xhtml',
			'comment_field'     => '<p class="comment-form-comment">
										<label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
										<textarea id="comment" name="comment" aria-required="true">' . '</textarea>
									</p>',
		)
	); ?>
</div><!-- #comments .comments-area -->
