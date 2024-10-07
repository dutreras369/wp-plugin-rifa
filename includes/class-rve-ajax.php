<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_Ajax {

    public function init() {
        add_action( 'wp_ajax_nopriv_rve_select_number', array( $this, 'handle_ajax_request' ) );
        add_action( 'wp_ajax_rve_select_number', array( $this, 'handle_ajax_request' ) );
    }

    public function handle_ajax_request() {
        $numero = isset( $_POST['numero'] ) ? sanitize_text_field( $_POST['numero'] ) : '';
        // Procesar el número seleccionado, bloquearlo si es necesario.

        wp_send_json_success( array( 'message' => 'Número seleccionado: ' . $numero ) );
    }
}
