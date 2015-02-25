<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package     WordPress
 * @subpackage     Timber
 * @since         Timber 0.1
 */

if (!class_exists('Timber')) {
        echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
        return;
}

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['categories'] = get_categories();

foreach ($context['categories'] as &$category) {
        $category->posts = get_posts(array('category_name' => $category->name));
}

$templates = array('base.twig');

$site = new TimberPost(81);
//$site = new TimberPost(632); //janek

$context = Timber::get_context();
        
if (is_home()) {
        array_unshift($templates, 'home.twig');
}

$context['site'] = $site;

Timber::render($templates, $context);
