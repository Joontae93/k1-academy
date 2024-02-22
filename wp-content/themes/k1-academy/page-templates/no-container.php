<?php
/**
 * Template Name: No Container
 *
 * @package KingdomOne
 */

get_header();
?>
<main class='<?php echo implode( ' ', get_post_class( array( 'container-fluid', 'site-content', $post->post_name ) ) ); ?>'>
	<?php the_content(); ?>
</main>
<?php
get_footer();
