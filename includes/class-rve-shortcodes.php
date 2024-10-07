<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_Shortcodes {

    public function register() {
        add_shortcode( 'rifa_display', array( $this, 'display_rifa_shortcode' ) );
    }

    public function display_rifa_shortcode( $atts ) {
        ob_start();

        // Aquí puedes colocar la lógica para mostrar la rifa, números disponibles y formulario.
        echo '<div class="rifa-display">';
        echo '<p>Rifa: ' . get_the_title() . '</p>';
        echo '<p>Selecciona tu número:</p>';
        // Mostrar formulario y lista de números...
        echo '</div>';

        return ob_get_clean();
    }
}
