<?php

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles(){
    // Chargement du style.css du thème parent Twenty Twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // Chargement du css/theme.css pour nos personnalisations
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
    // Chargement du /css/shortcodes/banniere-titre.css pour notre shortcode banniere titre
    wp_enqueue_style('image-produit-shortcode', get_stylesheet_directory_uri() . '/css/shortcodes/image-produit.css', array(), filemtime(get_stylesheet_directory() . '/css/shortcodes/image-produit.css'));

}


/* SHORTCODES */


// Je dis à wordpress que j'ajoute un shortcode 'banniere-titre'
add_shortcode('image-produit', 'image_produit_func');
// Je génère le html retourné par mon shortcode
function image_produit_func($atts)
{
    //Je récupère les attributs mis sur le shortcode
    $atts = shortcode_atts(array(
        'src' => '',
        'titre' => 'Titre'
    ), $atts, 'image-produit');

    //Je commence à récupéré le flux d'information
    ob_start();

    if ($atts['src'] != "") {
        ?>

        <div class="image-produit" style="background-image: url(<?= $atts['src'] ?>)">
            <h3 class="titre"><?= $atts['titre'] ?></h3>
        </div>

        <?php
    }

    //J'arrête de récupérer le flux d'information et le stock dans la fonction $output
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}