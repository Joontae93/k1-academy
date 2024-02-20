<?php
/**
 * Block render function
 *
 * @package KingdomOne
 * @subpackage K1AcademyThemeBlocks
 */

$slides = new WP_Query(
	array(
		'post_type'      => 'homepage-slide',
		'posts_per_page' => 6,
		'orderby'        => 'slider_order',
		'order'          => 'ASC',
	)
);
if ( ! $slides->have_posts() ) {
	return;
}
?>
<div class="swiper py-1 mb-4" id="homepage-banner-swiper">
	<div class="swiper-wrapper">
		<?php while ( $slides->have_posts() ) : ?>
		<?php
			$slides->the_post();
			$slider_link = get_field( 'slider_url' );
			$target      = empty( $slider_link['target'] ) ? '' : 'target="' . $slider_link['target'] . '"';
			?>
		<div class="swiper-slide mx-0 d-flex">
			<a href="<?php $slider_link['url']; ?>" class='d-block w-100' <?php echo $target; ?> aria-label="<?php the_title(); ?>" title="<?php the_title(); ?>">
				<?php
				the_post_thumbnail(
					'banner-image',
					array(
						'loading' => 'lazy',
						'class'   => 'object-fit-cover h-100 w-100',
					)
				);
				?>
			</a>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
	<div class="autoplay-progress">
		<svg viewBox="0 0 48 48">
			<circle cx="24" cy="24" r="20"></circle>
		</svg>
	</div>
	<div class="swiper-pagination homepage-swiper-pagination"></div>
</div>
