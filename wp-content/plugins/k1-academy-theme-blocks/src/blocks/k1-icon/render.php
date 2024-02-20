<?php
/**
 * A K1 Icon
 *
 * @package KingdomOne
 */

$background_color  = $attributes['backgroundColor'];
$icon              = $attributes['icon'];
$icon_color        = $attributes['iconColor'];
$headline          = isset( $attributes['headline'] ) ? $attributes['headline'] : '';
$headline_color    = $attributes['headlineColor'];
$subheadline       = empty( $attributes['subheadline'] ) ? '' : $attributes['subheadline'];
$subheadline_color = $attributes['subheadlineColor'];
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'container' ) ); ?>>
	<div class="row justify-content-around">
		<div class="icon__background col-lg-3 d-flex justify-content-center align-items-center p-5"
			style="background-color: <?php echo $background_color; ?>;border-radius:50%;width:250px;height:250px;">
			<?php the_k1_icon( $icon, $icon_color ); ?>
		</div>
		<div class="col-lg-8 d-flex flex-column justify-content-center">
			<h2 class="headline" style="color:<?php echo $headline_color; ?>"><?php echo $headline; ?></h2>
			<p class="subheadline" style="color:<?php echo $headline_color; ?>"><?php echo $subheadline; ?></p>

		</div>
	</div>
</div>