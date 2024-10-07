<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_CPT {

    public function register() {
        add_action( 'init', array( $this, 'register_rifas_cpt' ) );
    }

    public function register_rifas_cpt() {
        $labels = array(
            'name' => __( 'Rifas', 'textdomain' ),
            'singular_name' => __( 'Rifa', 'textdomain' ),
            'menu_name' => __( 'Rifas', 'textdomain' ),
            'name_admin_bar' => __( 'Rifa', 'textdomain' ),
            'add_new' => __( 'Agregar Nueva', 'textdomain' ),
            'add_new_item' => __( 'Agregar Nueva Rifa', 'textdomain' ),
            'new_item' => __( 'Nueva Rifa', 'textdomain' ),
            'edit_item' => __( 'Editar Rifa', 'textdomain' ),
            'view_item' => __( 'Ver Rifa', 'textdomain' ),
            'all_items' => __( 'Todas las Rifas', 'textdomain' ),
            'search_items' => __( 'Buscar Rifas', 'textdomain' ),
            'not_found' => __( 'No se encontraron Rifas.', 'textdomain' ),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'show_in_menu' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon' => 'dashicons-tickets',
        );

        register_post_type( 'rifas', $args );
    }
}
