<?php
/**
 * Standard Page Output with default Hero section
 *
 * @package KingdomOne
 */

get_header();
?>
<main class='<?php echo "site-content {$post->post_name}"; ?>'>
	<article class="container">
		<?php the_content(); ?>
	</article>
</main>
<?php
get_footer();
