<?php
/**
 * Basic Footer Template
 *
 * @since 1.0
 * @package KingdomOne
 */

?>

<footer class="footer bg-dark py-5 container-fluid gx-5 text-white text-center d-flex flex-column align-items-center">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-4">
				<a href="<?php echo esc_url( site_url() ); ?>" class="logo" aria-label="to Home Page">
					<figure class="logo-img d-inline-block w-100 h-100">
						<?php echo file_get_contents( get_template_directory() . '/img/k1-academy-solid.svg' ); ?>
					</figure>
				</a>
			</div>
			<div class="col-4">
				<?php
				if ( has_nav_menu( 'footer_menu' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'footer_menu',
							'menu_class'      => 'footer-nav list-unstyled navbar-nav flex-row',
							'container'       => 'nav',
							'container_class' => 'navbar',
						)
					);
				}
				?>
			</div>
		</div>
		<div class="row my-5">
			<div id="copyright">
				<?php echo '&copy;&nbsp;' . gmdate( 'Y' ) . '&nbsp;Kingdom One.'; ?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
