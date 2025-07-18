<?php
/**
 * Rikiya Portfolio Theme Functions
 * This file adds WordPress functionality to your theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function rikiya_portfolio_setup() {
    // Add theme support for various WordPress features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'rikiya-portfolio'),
    ));
}
add_action('after_setup_theme', 'rikiya_portfolio_setup');

/**
 * Enqueue Scripts and Styles
 */
function rikiya_portfolio_scripts() {
    // Enqueue styles
    wp_enqueue_style('rikiya-portfolio-style', get_stylesheet_uri());
    
    // Enqueue Swiper CSS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    
    // Enqueue scripts
    wp_enqueue_script('jquery');
    
    // Enqueue Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
    
    // Enqueue theme JavaScript (load after Swiper)
    wp_enqueue_script('rikiya-portfolio-main', get_template_directory_uri() . '/assets/js/app.js', array('jquery', 'swiper-js'), '1.0', true);
    
    // Enqueue Instagram embed script
    wp_enqueue_script('instagram-embed', '//www.instagram.com/embed.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'rikiya_portfolio_scripts');

/**
 * Custom Post Types
 */
function rikiya_portfolio_custom_post_types() {
    
    // Projects Post Type
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
            'add_new' => 'Add New Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'new_item' => 'New Project',
            'view_item' => 'View Project',
            'search_items' => 'Search Projects',
            'not_found' => 'No projects found',
            'not_found_in_trash' => 'No projects found in trash',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
    ));
    
    // Skills Post Type
    register_post_type('skill', array(
        'labels' => array(
            'name' => 'Skills',
            'singular_name' => 'Skill',
            'add_new' => 'Add New Skill',
            'add_new_item' => 'Add New Skill',
            'edit_item' => 'Edit Skill',
            'new_item' => 'New Skill',
            'view_item' => 'View Skill',
            'search_items' => 'Search Skills',
            'not_found' => 'No skills found',
            'not_found_in_trash' => 'No skills found in trash',
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'skills'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_rest' => true,
    ));
}
add_action('init', 'rikiya_portfolio_custom_post_types');

/**
 * Custom Fields for Projects
 */
function rikiya_portfolio_project_meta_boxes() {
    add_meta_box(
        'project-details',
        'Project Details',
        'rikiya_portfolio_project_details_callback',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'rikiya_portfolio_project_meta_boxes');

function rikiya_portfolio_project_details_callback($post) {
    wp_nonce_field('rikiya_portfolio_project_details', 'rikiya_portfolio_project_details_nonce');
    
    $project_url = get_post_meta($post->ID, '_project_url', true);
    $project_tech = get_post_meta($post->ID, '_project_tech', true);
    $project_type = get_post_meta($post->ID, '_project_type', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="project_url">Project URL</label></th>';
    echo '<td><input type="url" id="project_url" name="project_url" value="' . esc_attr($project_url) . '" class="regular-text" /></td></tr>';
    echo '<tr><th><label for="project_tech">Technologies Used</label></th>';
    echo '<td><input type="text" id="project_tech" name="project_tech" value="' . esc_attr($project_tech) . '" class="regular-text" placeholder="React, TypeScript, etc." /></td></tr>';
    echo '<tr><th><label for="project_type">Project Type</label></th>';
    echo '<td><select id="project_type" name="project_type">';
    echo '<option value="web" ' . selected($project_type, 'web', false) . '>Web Development</option>';
    echo '<option value="design" ' . selected($project_type, 'design', false) . '>UI/UX Design</option>';
    echo '<option value="app" ' . selected($project_type, 'app', false) . '>Mobile App</option>';
    echo '<option value="other" ' . selected($project_type, 'other', false) . '>Other</option>';
    echo '</select></td></tr>';
    echo '</table>';
}

function rikiya_portfolio_save_project_details($post_id) {
    if (!isset($_POST['rikiya_portfolio_project_details_nonce']) || 
        !wp_verify_nonce($_POST['rikiya_portfolio_project_details_nonce'], 'rikiya_portfolio_project_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, '_project_url', sanitize_url($_POST['project_url']));
    }
    
    if (isset($_POST['project_tech'])) {
        update_post_meta($post_id, '_project_tech', sanitize_text_field($_POST['project_tech']));
    }
    
    if (isset($_POST['project_type'])) {
        update_post_meta($post_id, '_project_type', sanitize_text_field($_POST['project_type']));
    }
}
add_action('save_post', 'rikiya_portfolio_save_project_details');

/**
 * Theme Customizer
 */
function rikiya_portfolio_customizer($wp_customize) {
    // About Section
    $wp_customize->add_section('about_section', array(
        'title' => 'About Section',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('about_title', array(
        'default' => 'About Me',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label' => 'About Title',
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_bio', array(
        'default' => 'Your bio text here...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('about_bio', array(
        'label' => 'Bio Text',
        'section' => 'about_section',
        'type' => 'textarea',
    ));
    
    // Contact Section
    $wp_customize->add_section('contact_section', array(
        'title' => 'Contact Section',
        'priority' => 31,
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default' => 'rikiyadazo89@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label' => 'Contact Email',
        'section' => 'contact_section',
        'type' => 'email',
    ));
}
add_action('customize_register', 'rikiya_portfolio_customizer');

/**
 * Helper Functions
 */
function get_projects($limit = -1) {
    $args = array(
        'post_type' => 'project',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );
    
    return new WP_Query($args);
}

function get_skills($limit = -1) {
    $args = array(
        'post_type' => 'skill',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );
    
    return new WP_Query($args);
}
?>