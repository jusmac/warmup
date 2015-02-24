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
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.1
 */

	if (!class_exists('Timber')){
		echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
		return;
	}
	$context = Timber::get_context();
	$context['posts'] = Timber::get_posts();
	$context['categories'] = get_categories();
	foreach($context['categories'] as &$category){
		$category->posts = get_posts(array('category_name' => $category->name));
	}
	$templates = array('base.twig');
        
        
        
	/*
	object(stdClass)#1873 (15) {
      ["term_id"]=>
      &string(1) "1"
      ["name"]=>
      &string(13) "Bez kategorii"
      ["slug"]=>
      &string(13) "bez-kategorii"
      ["term_group"]=>
      string(1) "0"
      ["term_taxonomy_id"]=>
      string(1) "1"
      ["taxonomy"]=>
      string(8) "category"
      ["description"]=>
      &string(0) ""
      ["parent"]=>
      &string(1) "0"
      ["count"]=>
      &string(1) "1"
      ["cat_ID"]=>
      &string(1) "1"
      ["category_count"]=>
      &string(1) "1"
      ["category_description"]=>
      &string(0) ""
      ["cat_name"]=>
      &string(13) "Bez kategorii"
      ["category_nicename"]=>
      &string(13) "bez-kategorii"
      ["category_parent"]=>
      &string(1) "0"
    }*/
	if (is_home()){
		array_unshift($templates, 'home.twig');
	}
	Timber::render($templates, $context);


