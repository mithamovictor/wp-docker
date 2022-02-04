<?php
/**
 * Author: Karungaru Technologies
 * Author URI: https://www.karungarutechnologies.com
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package theme
 *
 */

?>

			<footer>
				<div class="footer-widget"><?php
					dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
				<div class="copyright">
					<p class="copyright-text">&copy; <?php echo date('Y'); ?> <?php bloginfo('title'); ?>. All rights reserved. <?php edit_post_link( __( '( Edit )', 'theme' ), '<span class="edit-link">', '</span>' ); ?></p>
				</div>
			</footer>
		</div> <!-- End of main-content -->
	<?php wp_footer(); ?>
	</body>
</html>
