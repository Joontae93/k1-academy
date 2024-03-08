<?php
/**
 * The Courses Swiper
 *
 * @package KingdomOne
 * @subpackage K1AcademyThemeBlocks
 */

$slides = new WP_Query(
	array(
		'post_type'      => 'course',
		'posts_per_page' => $attributes['count'],
		'tax_query'      => array(
			array(
				'taxonomy' => 'course_cat',
				'field'    => 'term_id',
				'terms'    => $attributes['categoryId'],
			),
		),
	)
);
?>
<?php
if ( ! $slides->have_posts() ) :
	return;
else :
	?>
<div class="<?php echo 'row alignwide my-5'; ?>" style="--swiper-navigation-color:var(--wp--preset--color--k-1-green-classic);">
	<div class="col-12">
		<h2 class="<?php echo "align{$attributes['align']}"; ?>"><?php echo esc_textarea( $attributes['label'] ); ?></h2>
		<div class='k1-block-courses-swiper swiper'>
			<div class="swiper-wrapper">
				<?php while ( $slides->have_posts() ) : ?>
				<?php $slides->the_post(); ?>
				<div class="swiper-slide">
					<a href="<?php echo esc_url( the_permalink() ); ?>" class="swiper-slide__container">
						<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'swiper-slide__image',
								'loading' => 'lazy',
							)
						);
						?>
						<div class="swiper-slide__image--overlay"></div>
						<?php the_title( '<h3 class="swiper-slide__title">', '</h3>' ); ?>
					</a>
				</div>
				<?php endwhile; ?>
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
</div>

<?php
endif;
wp_reset_postdata();