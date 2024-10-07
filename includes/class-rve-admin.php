<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RVE_Admin {

    public function init() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'admin_settings_init' ) );
    }

    // Añadir el menú personalizado en el área de administración
    public function add_admin_menu() {
        add_menu_page(
            __( 'Rifas Virtuales', 'textdomain' ),   // Título del menú
            __( 'Rifas Virtuales', 'textdomain' ),   // Texto del menú
            'manage_options',                        // Capacidad requerida para ver el menú
            'rve_rifas_admin',                       // Slug del menú
            array( $this, 'admin_page_html' ),       // Función que mostrará el contenido
            'dashicons-tickets',                     // Icono del menú
            6                                        // Posición del menú en el admin
        );

        // Submenú para historial de compras
        add_submenu_page(
            'rve_rifas_admin',
            __( 'Historial de Compras', 'textdomain' ),
            __( 'Historial de Compras', 'textdomain' ),
            'manage_options',
            'rve_historial_compras',
            array( $this, 'historial_compras_html' )
        );
    }

    // HTML de la página principal del menú
    public function admin_page_html() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <p>Desde aquí puedes gestionar las rifas activas y pasadas.</p>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column"><?php _e( 'Nombre de la Rifa', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Fecha de Inicio', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Fecha de Fin', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Estado', 'textdomain' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consultar todas las rifas (CPT 'rifas')
                    $args = array(
                        'post_type' => 'rifas',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                    );
                    $rifas = new WP_Query( $args );
                    if ( $rifas->have_posts() ) :
                        while ( $rifas->have_posts() ) : $rifas->the_post();
                            $fecha_inicio = get_post_meta( get_the_ID(), '_fecha_inicio', true );
                            $fecha_fin = get_post_meta( get_the_ID(), '_fecha_fin', true );
                            $estado = get_post_meta( get_the_ID(), '_estado_rifa', true ) == 'active' ? __( 'Activa', 'textdomain' ) : __( 'Inactiva', 'textdomain' );
                            ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html( $fecha_inicio ); ?></td>
                                <td><?php echo esc_html( $fecha_fin ); ?></td>
                                <td><?php echo esc_html( $estado ); ?></td>
                            </tr>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <tr>
                            <td colspan="4"><?php _e( 'No hay rifas disponibles.', 'textdomain' ); ?></td>
                        </tr>
                        <?php
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    // HTML de la página de historial de compras
    public function historial_compras_html() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <p>Aquí puedes ver el historial de compras de los participantes en las rifas.</p>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column"><?php _e( 'Nombre del Comprador', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Número Comprado', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Rifa', 'textdomain' ); ?></th>
                        <th class="manage-column"><?php _e( 'Estado del Pago', 'textdomain' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Aquí deberías consultar la base de datos o usar post_meta para obtener el historial de compras.
                    // Esto puede ser más complejo dependiendo de cómo se haya implementado la lógica de compras.
                    // Un ejemplo básico podría ser:
                    
                    // Reemplaza esta consulta con la lógica de compras real que tengas implementada.
                    // Esta es solo una estructura base.
                    ?>
                    <tr>
                        <td>Ejemplo Comprador</td>
                        <td>45</td>
                        <td>Ejemplo Rifa</td>
                        <td><?php _e( 'Pagado', 'textdomain' ); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }

    // Inicialización de ajustes para rifas
    public function admin_settings_init() {
        register_setting( 'rveSettings', 'rve_settings' );

        add_settings_section(
            'rve_section',
            __( 'Configuración de Rifas', 'textdomain' ),
            array( $this, 'settings_section_callback' ),
            'rveSettings'
        );

        add_settings_field(
            'rve_field_webpay', 
            __( 'Clave de WebPay', 'textdomain' ),
            array( $this, 'webpay_field_render' ),
            'rveSettings',
            'rve_section'
        );
    }

    public function settings_section_callback() {
        echo __( 'Configura la integración con WebPay aquí.', 'textdomain' );
    }

    public function webpay_field_render() {
        $options = get_option( 'rve_settings' );
        ?>
        <input type='text' name='rve_settings[rve_field_webpay]' value='<?php echo $options['rve_field_webpay'] ?? ''; ?>'>
        <?php
    }
}
