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
	<section class="article-container pg404">
		<article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
			<div class="content-container">
				<h2>Error 404!</h2>
				<p>Sorry, the page you are looking for was not found. Please try one of the pages above.</p>
			</div>
		</article>
	</section>
</main><?php

get_footer();
