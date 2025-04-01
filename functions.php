<?php

function custom_theme_scripts()
{
    // Enqueue CSS files
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), '4.0.0');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/css/style.css', array(), '1.0.0');

    // Deregister default WordPress jQuery and load a custom version
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.1.min.js', array(), '2.2.1', true);

    // Enqueue JavaScript files
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), '4.0.0', true);
    wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js', array('jquery'), '1.0.0', true);
}


add_action('wp_enqueue_scripts', 'custom_theme_scripts');


function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}


function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


function remove_admin_bar()
{
    return false;
}


// ACF BLOCK register

if (function_exists('acf_register_block_type')) {
    function register_custom_acf_block()
    {
        acf_register_block_type(array(
            'name'              => 'custom-section',
            'title'             => __('Custom Section'),
            'description'       => __('A custom section block with editable content.'),
            'render_template'   => get_template_directory() . '/blocks/custom-section/index.php',


            'category'          => 'layout',
            'icon'              => 'admin-site-alt3',
            'keywords'          => array('custom', 'section'),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => true
            )
        ));
    }
    add_action('acf/init', 'register_custom_acf_block');
}






register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'secondary' => __('Secondary Menu'),
));

add_filter('body_class', 'add_slug_to_body_class');
add_filter('show_admin_bar', 'remove_admin_bar');
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
require_once 'class-wp-bootstrap-navwalker.php';

remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

// Removes from admin menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');
add_filter('wpml_custom_field_original_data', 'disable_original_lang_data');

function disable_original_lang_data()
{
    return;
}


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Footer',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'footer',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}
add_action('dashboard_glance_items', 'cpad_at_glance_content_table_end');
function cpad_at_glance_content_table_end()
{
    $args = array(
        'public' => true,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';

    $post_types = get_post_types($args, $output, $operator);
    foreach ($post_types as $post_type) {
        $num_posts = wp_count_posts($post_type->name);
        $num = number_format_i18n($num_posts->publish);
        $text = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
        if (current_user_can('edit_posts')) {
            $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
            echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
        }
    }
}
