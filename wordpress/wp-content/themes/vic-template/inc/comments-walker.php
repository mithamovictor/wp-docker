<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

class comment_walker extends Walker_Comment {
	var $tree_type = 'comment';
	var $db_fields = [ 'parent' => 'comment_parent', 'id' => 'comment_ID' ];

	// constructor – wrapper for the comments list
	function __construct() { ?>
		<section class="comment-section comments-list"><?php
	}

	// start_lvl – wrapper for child comments list
	function start_lvl( &$output, $depth = 0, $args = [] ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>
		<section class="child-comments comments-list"><?php
	}

	// end_lvl – closing wrapper for child comments list
	function end_lvl( &$output, $depth = 0, $args = [] ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>
		</section><?php
	}

	// start_el – HTML for comment template
	function start_el( &$output, $comment, $depth = 0, $args = [], $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

		if ( 'article' == $args['style'] ):
			$tag = 'article';
			$add_below = 'comment';
    else:
			$tag = 'article';
			$add_below = 'comment';
		endif; ?>

		<div <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
			<div class="author-meta">
				<figure class="gravatar"><?php
					echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?>
				</figure>
				<div class="comment-meta post-meta" role="complementary">
					<p class="comment-author">
						<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
					</p>
					<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>,
						<a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a>
					</time><?php

					if ($comment->comment_approved == '0') : ?>
						<p class="comment-meta-item">Your comment is awaiting moderation.</p><?php
					endif; ?>
				</div>
			</div>

			<div class="comment-content post-content" itemprop="text">
				<?php comment_text() ?>
				<div class="comment-links"><?php
					edit_comment_link('Edit','','');
					comment_reply_link(
						array_merge(
							$args,
							[
								'add_below' => $add_below,
								'depth' => $depth,
								'max_depth' => $args[
									'max_depth'
								]
							]
						)
					) ?>
				</div>
			</div><?php
  }

  // end_el – closing HTML for comment template
  function end_el(&$output, $comment, $depth = 0, $args = [] ) { ?>
		</div><?php
	}

	// destructor – closing wrapper for the comments list
	function __destruct() { ?>
		</section><?php
	}
}
?>
