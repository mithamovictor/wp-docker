<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

get_header();?>

<main class="main-container">
	<section class="content"><?php
		if (have_posts()):
			get_template_part( 'template-parts/content', 'post' );
		endif; ?>
	</section>
</main><?php

get_footer();
