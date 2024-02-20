<?php
/**
 * Content Color Toggle
 *
 * @package KingdomOne
 */

?>
<div class="dropdown">
	<button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
			data-bs-display="static" aria-label="Toggle theme (dark)">
		<i class="bi-moon-stars-fill my-1 theme-icon-active"></i>
		<span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
	</button>
	<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
		<li>
			<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
				<i class="bi-sun-fill me-2 opacity-50 theme-icon"></i>
				Light
				<i class="bi-check-2 ms-auto d-none"></i>
			</button>
		</li>
		<li>
			<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="dark" aria-pressed="true">
				<i class="bi-moon-stars-fill me-2 opacity-50 theme-icon"></i>
				Dark
				<i class="bi-check-2 ms-auto d-none"></i>
			</button>
		</li>
		<li>
			<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
				<i class="bi-circle-half me-2 opacity-50 theme-icon"></i>
				Auto
				<i class="bi-check-2 ms-auto d-none"></i>
			</button>
		</li>
	</ul>
</div>
