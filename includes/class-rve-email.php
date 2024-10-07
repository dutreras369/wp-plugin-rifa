<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_Email {

    public function init() {
        add_action( 'rve_rifa_compra_exitosa', array( $this, 'enviar_confirmacion_compra' ) );
    }

    public function enviar_confirmacion_compra( $datos ) {
        $to = $datos['email'];
        $subject = 'Confirmación de Compra - Rifa';
        $message = 'Gracias por participar en la rifa. Tu número es: ' . $datos['numero'];
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail( $to, $subject, $message, $headers );
    }
}
