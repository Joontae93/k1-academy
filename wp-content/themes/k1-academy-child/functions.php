<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to Pro in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter('x_enqueue_parent_stylesheet', '__return_true');


// Additional Functions
// =============================================================================

/**
 * enqueue child styles & scripts
 */
function child_enqueue_styles() {
    wp_enqueue_style('k1-academy-Styles', get_stylesheet_directory_uri() . '/build/index.css', array(), '1.1.0');
    wp_enqueue_script('k1-academy-data', get_stylesheet_directory_uri() . '/build/index.js', array(), '2.0.0', true);
    wp_localize_script('k1-academy-data', 'k1AcademyData', array(
        'root_url' => get_site_url(),
        'day' => date('D'),
        'year' => date('Y')
    ));
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles');

include_once get_theme_file_path('/includes/llms-customizations.php');