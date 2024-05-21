<?php
/**
 * Syllabus Template
 *
 * @package KingdomOne
 * @subpackage LifterLMS
 */

defined( 'ABSPATH' ) || exit;
global $post;
$course   = new LLMS_Course( $post );
$sections = $course->get_sections();
?>

<div class="clear"></div>
<div class="llms-syllabus-wrapper">
	<?php
	if ( ! $sections ) {
		echo '<p>This course does not have any sections.</p>';

	} else {
		foreach ( $sections as $section ) {
			$lesson_order = 0;
			echo "<div class='llms-section-wrapper'>";
			if ( apply_filters( 'llms_display_outline_section_titles', true ) ) {
				echo '<h3 class="llms-h3 llms-section-title">' . get_the_title( $section->get( 'id' ) ) . '</h3>';
			}
			$lessons = $section->get_lessons();
			if ( $lessons ) {
				foreach ( $lessons as $lesson ) {
					llms_get_template(
						'course/lesson-preview.php',
						array(
							'lesson'        => $lesson,
							'total_lessons' => count( $lessons ),
							'order'         => ++$lesson_order,
						)
					);
				}
			} else {
				echo '<p>This section does not have any lessons.</p>';
			}
			echo '</div>';
		}
	}
	?>
	<div class="clear"></div>
</div>
