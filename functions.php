<?php
/**
 * OceanWP Child Theme Functions
 *
 * When running a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions will be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {

	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	 // Load the stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
	
	// Chargement du css/theme.css pour nos personnalisations
	 wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
   
   
}

add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

	//ajout onglet admin si connecté
	
function add_admin_menu_item($items, $args) {
	
	if (is_user_logged_in() && $args->theme_location == 'main_menu') {

		$items ='<li class="menu-item-26"><a href="http://localhost:8888/PlantyP6/nous-contacter/">Nous rencontrer</a></li>
					<li class="menu-item-27"><a href="http://localhost:8888/PlantyP6/admin/">Admin</a></li>
					<li class="menu-item-25"><a href="http://localhost:8888/PlantyP6/precommande/">Commander</a></li>';
		
    }
		return $items;
	
}

add_filter('wp_nav_menu_items','add_admin_menu_item', 10, 2);

