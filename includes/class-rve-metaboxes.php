<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_Metaboxes {

    public function init() {
        add_action( 'add_meta_boxes', array( $this, 'add_rifas_metaboxes' ) );
        add_action( 'save_post', array( $this, 'save_rifas_metaboxes' ) );
    }

    public function add_rifas_metaboxes() {
        add_meta_box(
            'rve_rifas_details',
            __( 'Detalles de la Rifa', 'textdomain' ),
            array( $this, 'render_metabox' ),
            'rifas',
            'normal',
            'high'
        );
    }

    public function render_metabox( $post ) {
        // Obtener metadatos actuales
        $cantidad_numeros = get_post_meta( $post->ID, '_cantidad_numeros', true );
        $precio_numero = get_post_meta( $post->ID, '_precio_numero', true );
        $fecha_inicio = get_post_meta( $post->ID, '_fecha_inicio', true );
        $fecha_fin = get_post_meta( $post->ID, '_fecha_fin', true );

        // Agregar nonce para seguridad
        wp_nonce_field( basename( __FILE__ ), 'rve_rifa_nonce' );

        ?>
        <p>
            <label for="cantidad_numeros"><?php _e( 'Cantidad de Números:', 'textdomain' ); ?></label>
            <input type="number" name="cantidad_numeros" value="<?php echo esc_attr( $cantidad_numeros ); ?>" />
        </p>
        <p>
            <label for="precio_numero"><?php _e( 'Precio por Número:', 'textdomain' ); ?></label>
            <input type="number" name="precio_numero" value="<?php echo esc_attr( $precio_numero ); ?>" />
        </p>
        <p>
            <label for="fecha_inicio"><?php _e( 'Fecha de Inicio:', 'textdomain' ); ?></label>
            <input type="date" name="fecha_inicio" value="<?php echo esc_attr( $fecha_inicio ); ?>" />
        </p>
        <p>
            <label for="fecha_fin"><?php _e( 'Fecha de Fin:', 'textdomain' ); ?></label>
            <input type="date" name="fecha_fin" value="<?php echo esc_attr( $fecha_fin ); ?>" />
        </p>
        <?php
    }

    public function save_rifas_metaboxes( $post_id ) {
        if ( ! isset( $_POST['rve_rifa_nonce'] ) || ! wp_verify_nonce( $_POST['rve_rifa_nonce'], basename( __FILE__ ) ) ) {
            return $post_id;
        }

        $new_cantidad = isset( $_POST['cantidad_numeros'] ) ? sanitize_text_field( $_POST['cantidad_numeros'] ) : '';
        update_post_meta( $post_id, '_cantidad_numeros', $new_cantidad );

        $new_precio = isset( $_POST['precio_numero'] ) ? sanitize_text_field( $_POST['precio_numero'] ) : '';
        update_post_meta( $post_id, '_precio_numero', $new_precio );

        $new_fecha_inicio = isset( $_POST['fecha_inicio'] ) ? sanitize_text_field( $_POST['fecha_inicio'] ) : '';
        update_post_meta( $post_id, '_fecha_inicio', $new_fecha_inicio );

        $new_fecha_fin = isset( $_POST['fecha_fin'] ) ? sanitize_text_field( $_POST['fecha_fin'] ) : '';
        update_post_meta( $post_id, '_fecha_fin', $new_fecha_fin );
    }
}
