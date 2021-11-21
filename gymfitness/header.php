<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <?php wp_head(); ?>
</head>
<body>
    
<header class="site-header">
    <div class="contenedor"> 
        <div class="barra-navegacion">
            <div class="logo">
            <a href="<?php echo esc_url(site_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Imagen del logo">
                </a>
            </div>    
            <nav>
              
                <?php
                
                $args = array(
                    'theme_location' => 'menu-principal',
                    'container' => 'nav',
                    'container_class' => 'menu-principal' /* para asignar una clase css */
                );

                wp_nav_menu($args);

                ?>   

            </nav>
        </div>
    </div>
</header>