<?php
/**
 * Single hotel template.
 *
 * This template can be overriden by copying this file to your-theme/templates/single-hotel.php
 *
 * @author 		Johan Nordström
 * @package 	WCMS Plugin Helper/Templates
 * @version     1.0.0
 */

if (!defined('ABSPATH')) exit; // Don't allow direct access

get_header();
the_post();
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<div class="entry-meta"></div><!-- .entry-meta -->
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="post-thumbnail">
					<?php the_post_thumbnail('large'); ?>
				</div><!-- .post-thumbnail -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
