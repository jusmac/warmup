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
$templates = array('base.twig');
$site = new TimberSite();
$context['site'] = $site;
        
if (is_home()) {
    array_unshift($templates, 'home.twig');

    $context['is_homepage'] = true;
    $context['homepage_content'] = array();

    foreach ($context['menu']->items as $item) {
        if ($item->type == 'post_type') {
                $post = new TimberPost($item->_menu_item_object_id);
                $context['homepage_content'][] = array(
                      'id' => $item->ID,
                      'type' => 'post',
                      'slug' => $post->post_name,
                      'post' => $post
                );
        } else if ($item->type == 'taxonomy') {
            $timberPosts = array();

            $posts = get_posts(array('category' => $item->_menu_item_object_id));
            foreach ($posts as $post) {
                $timberPosts[] = new TimberPost($post->ID);
            }

            $context['homepage_content'][] = array(
              'id' => $item->ID,
              'type' => 'list',
              'slug' => $item->slug,
              'content' => $timberPosts
            );
        }
    }
}

//chcesz posta? proszę, na przykład tak:
$context['post_81'] = new TimberPost(81);

Timber::render($templates, $context);

echo "<!--\n";

var_dump($context['menu']);

echo "\n-->\n";
