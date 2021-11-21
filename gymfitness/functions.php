<?php

/* Consultas reutilizables */
require get_template_directory() . '/inc/queries.php';
require get_template_directory() . '/inc/shortcodes.php';

// Cuando el tema es activado
    function gymfitness_setup() {
        
        // Titulos en la pagina para el SEO
        add_theme_support('title-tag');

        //Habilitar imagenes destacadas
        add_theme_support('post-thumbnails');

        add_image_size('square', 350, 350, true);
        add_image_size('portrait', 350, 724, true);
        add_image_size('cajas', 400, 375, true);
        add_image_size('mediano', 700, 400, true);
        add_image_size('blog', 966, 644, true);
    }

    add_action('after_setup_theme', 'gymfitness_setup');

// Nos permite agregar mas menus utilizando un arreglo
    function menus_gimnasio() {
         register_nav_menus(array(
            'menu-principal' => __('Menu Principal', 'gymfitness')
         ));
    }

    add_action('init', 'menus_gimnasio');

    // Styles

    function gimnasio_scripts_styles() {

        wp_enqueue_style('normalize', get_template_directory_uri() .'/css/normalize.css', array(), '8.0.1');

        wp_enqueue_style('slickNavCSS', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.10');

        wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Raleway:wght@400;700;900&family=Bebas+Neue&display=swap', array(), '1.0.0');
        
        if (is_page('galeria')):
            wp_enqueue_style('lightboxCSS', get_template_directory_uri() . '/css/lightbox.min.css', array(), '2.11.2',);
        endif;

        if (is_page('contacto')):
            wp_enqueue_style('leafletCSS', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', array(), '1.7.1');
        endif;

        if (is_page('inicio')):
            wp_enqueue_style('bxSlider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', array(), '4.2.12');
        endif;

        //la hoja d estilos principal
        wp_enqueue_style('style', get_stylesheet_uri(), array('normalize', 'googleFonts'),'1.0.0');

        wp_enqueue_script('slicknavJS', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '1.0.10', true);

        if (is_page('galeria')):
            wp_enqueue_script('lightboxJS', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), '2.11.2', true);
        endif;

        if (is_page('contacto')):
            wp_enqueue_script('leafletJS', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), '1.7.1', true);
        endif;

        if (is_page('inicio')):
            wp_enqueue_script('bxSliderJS', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '4.2.12', true);
        endif;

        wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'slicknavJS'), '1.0.10', true);
    }

    add_action('wp_enqueue_scripts', 'gimnasio_scripts_styles');

/*   nombrar las funciones con nombres unicos para no override nombres de plugins.
    funciones personalizadas
    no hay patron de model view controller en wordpress

    wordpress da una funcion para registrar menus function register_nav_menus
    en el array si el value antecede por __ permite que ese texto se pueda traducir

    Se crea la funcion y luego se hace el hook para que se muestre en WP */

    //Definir zona de widgets

    function gymfitness_widgets() {
        register_sidebar( array(
            'name' => 'Sidebar 1',
            'id' => 'sidebar_1',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="texto-primario text-center">',
            'after_title' => '</h3>'
        ));
        register_sidebar( array(
            'name' => 'Sidebar 2',
            'id' => 'sidebar_2',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="texto-primario text-center">',
            'after_title' => '</h3>'
        ));
    }

    add_action( 'widgets_init', 'gymfitness_widgets' );
  
/* Imagen Hero */

function gymfitness_hero_image() {
    // obtener id de la pagina principal
    $front_page_id = get_option('page_on_front');
    // obtener id de la imagen
    $id_imagen = get_field('imagen_hero', $front_page_id);
    // Obtener la imagen
    $imagen = wp_get_attachment_image_src($id_imagen, 'full')[0];    
    // Style CSS
    wp_register_style('custom', false);
    wp_enqueue_style('custom');

    $imagen_destacada_css = "
        body.home .site-header {
            background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url($imagen);
        }
    ";

    wp_add_inline_style('custom', $imagen_destacada_css);

}

add_action('init', 'gymfitness_hero_image');
