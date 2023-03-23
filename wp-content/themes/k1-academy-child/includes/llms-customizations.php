<?php

/**
 * Lifter LMS Sidebar Functions
 * 
 * @since 1.0
 * @author KJ Roelke
 */
?>

<?php
/**
 * Display LifterLMS Course and Lesson sidebars on courses and lessons in place of the sidebar returned by this function
 * 
 * @param string $id default sidebar id (an empty string)
 * @return string
 */
function my_llms_sidebar_function(string $id): string {

    $my_sidebar_id = 'sidebar-main'; // replace this with your theme's sidebar ID

    return $my_sidebar_id;
}
add_filter('llms_get_theme_default_sidebar', 'my_llms_sidebar_function');


/**
 * Declare explicit theme support for LifterLMS course and lesson sidebars
 * @return void
 */
function my_llms_theme_support(): void {
    add_theme_support('lifterlms-sidebars');
}
add_action('after_setup_theme', 'my_llms_theme_support');



/**
 * 
 * Add X-Container Styles to Lifter LMS via Hooks
 * 
 */
function begin_x_container(): void {
    echo '<div class="x-container max width">';
}
function end_x_container() {
    echo '</div>';
}
add_action('lifterlms_before_main_content', 'begin_x_container');
add_action('lifterlms_after_main_content', 'end_x_container');
