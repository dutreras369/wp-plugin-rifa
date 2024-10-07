<?php
/*
Plugin Name: Rifa Virtual Espacios
Description: Plugin para gestionar rifas virtuales con selección de números y pasarela de pago.
Version: 1.0
Author: Tu Nombre
Text Domain: rifa-virtual-espacios
*/

// Evitar acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Incluir archivos de clase
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-metaboxes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-shortcodes.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-ajax.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-email.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-webpay.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-rve-admin.php';

// Inicializar el plugin
function run_rve_plugin() {
    // Inicializar Custom Post Types
    $rve_cpt = new RVE_CPT();
    $rve_cpt->register();

    // Inicializar Metaboxes
    $rve_metaboxes = new RVE_Metaboxes();
    $rve_metaboxes->init();

    // Inicializar Shortcodes
    $rve_shortcodes = new RVE_Shortcodes();
    $rve_shortcodes->register();

    // Inicializar AJAX
    $rve_ajax = new RVE_Ajax();
    $rve_ajax->init();

    // Inicializar Email
    $rve_email = new RVE_Email();
    $rve_email->init();

    // Inicializar WebPay o WooCommerce
    $rve_webpay = new RVE_WebPay();
    $rve_webpay->init();

    // Inicializar Panel de Administración
    $rve_admin = new RVE_Admin();
    $rve_admin->init();
}
add_action( 'plugins_loaded', 'run_rve_plugin' );

// Cargar Bootstrap, estilos y scripts personalizados en el frontend
function rve_enqueue_frontend_assets() {
    
    // Encolar tu archivo CSS personalizado
    wp_enqueue_style( 'rve-frontend-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0' );
    
    // Encolar Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true );
    
    // Encolar tu archivo JS personalizado
    wp_enqueue_script( 'rve-frontend-script', plugin_dir_url( __FILE__ ) . 'assets/js/rifa.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'rve_enqueue_frontend_assets' );

function rve_enqueue_admin_assets() {
    // Cargar Bootstrap CSS en el backend
    
    // Cargar CSS personalizado para el backend
    wp_enqueue_style( 'rve-admin-style', plugin_dir_url( __FILE__ ) . 'assets/css/admin-style.css', array(), '1.0' );
    
    // Cargar Bootstrap JS en el backend
    wp_enqueue_script( 'bootstrap-js-admin', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true );	wp_enqueue_script( 'bootstrap-js-admin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'));

    // Cargar JS personalizado para el backend
    wp_enqueue_script( 'rve-admin-script', plugin_dir_url( __FILE__ ) . 'assets/js/admin-scripts.js', array('jquery'), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'rve_enqueue_admin_assets' );