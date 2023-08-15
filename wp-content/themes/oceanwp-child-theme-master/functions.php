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

	// Contrôle si l'utilisateur est connecté avec la fonction is_user_logged_in()
	if (is_user_logged_in() && $args->theme_location == 'main_menu') {
		// si l'utilisateur est connecté, on initialise un tableau qui stockera la liste des items 
		$items_array = array();
		
		// Création d'une boucle pour récupérer la position actuelle de chaque item (balise '<li') avec '<li' comme point de repère dans la liste de items
		// l'offset de 10, permet d'être sûr de ne pas prendre en compte le '<li' où on démarre
		while ( false !== ( $item_pos = strpos ( $items, '<li', 10 ) ) ) {
			// recupère uniquement la partie qui va de <li> jusqu'au <li> suivant et on le stock dans le tableau
			$items_array[] = substr($items, 0, $item_pos);
			// Retrait de la partie de la liste des items avant de recommencer la boucle
			$items = substr($items, $item_pos);
		}
		
		
	
		//Ajoute au tableau le dernier élément de la liste
		$items_array[] = $items;


		// Insertion du lien 'Admin' à la position indiquée ici c'est 1 pour qu'il soit en première place dans le tableau.
		array_splice($items_array, 1, 0, '<li class="menu-item"><a href="'. get_admin_url() .'">Admin</a></li>'); 
		//Retransforme le tableau en liste d'items
		$items = implode('', $items_array);
	}

	return $items;	

}

add_filter('wp_nav_menu_items','add_admin_menu_item', 10, 2);

