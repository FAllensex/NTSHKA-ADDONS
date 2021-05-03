<?php

/**
 * Ntshka Addons
 *
 * @author            Asper Designs
 * @copyright         2021 Asper Designs
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:      Ntshka Addons
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Addons For elementor
 * Version:           1.0.0
 * tested up to:      5.7
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Asper Designs
 * Author URI:        https://nikushasirbiladze.xyz
 * Text Domain:       ntashka-addons
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

 if( ! defined( 'ABSPATH' ) ) exit();

 /**
 * Elementor Extension main CLass
 * @since 1.0.0
 */

final class ntshka_addons {

    
    // Plugin version
    const VERSION = '1.0.0';

    // Minimum Elementor Version
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    // Minimum PHP Version
    const MINIMUM_PHP_VERSION = '7.0';

    // Instance
    private static $_instance = null;

    /**
    * SIngletone Instance Method
    * @since 1.0.0
    */
    public static function instance() {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    /**
    * Construct Method
    * @since 1.0.0
    */
    public function __construct() {
        // Call Constants Method
        $this->define_constants();
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts_styles' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Define Plugin Constants
    * @since 1.0.0
    */
    public function define_constants() {
        define( 'NTSHKA_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
        define( 'NTSHKA_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
    }


    /**
    * Load Scripts & Styles
    * @since 1.0.0
    */
    public function scripts_styles() {
       

        wp_register_style( 'ntshka-style', NTSHKA_PLUGIN_URL . 'assets/source/css/public.css', [], rand(), 'all' );
        wp_register_style( 'ntshka-swiper', NTSHKA_PLUGIN_URL . 'assets/source/css/ntshka-swiper.css', [], rand(), 'all' );
        wp_register_script( 'ntshka-script', NTSHKA_PLUGIN_URL . 'assets/source/js/public.js', [ 'jquery' ], rand(), true );

    }

    /**
    * Initialize the plugin
    * @since 1.0.0
    */
    public function init() {
        // Check if the ELementor installed and activated
        if( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        if( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        if( ! version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        add_action( 'elementor/init', [ $this, 'init_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }

    /**
    * Init Widgets
    * @since 1.0.0
    */
    public function init_widgets() {
        require_once NTSHKA_PLUGIN_PATH . '/widgets/pricing-ntshka.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/headline-ntshka.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/ntshka-date.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/ntshka-card.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/ntshka-card2.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/ntshka-faq.php';
        require_once NTSHKA_PLUGIN_PATH . '/widgets/ntshka-timeline.php';
    }
    
   
    /**
    * Init Category Section
    * @since 1.0.0
    */
    public function init_category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'ntshka-addons-category',
            [
                'title' => 'ntshka-addons'
            ],
            1
        );
    }

    /**
    * Admin Notice
    * Warning when the site doesn't have Elementor installed or activated
    * @since 1.0.0
    */
    public function admin_notice_missing_main_plugin() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated', 'ntshka-addons' ),
            '<strong>'.esc_html__( 'Ntshka Addons', 'ntshka-addons' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'ntshka-addons' ).'</strong>'
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required Elementor version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_elementor_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'ntshka-addons' ),
            '<strong>'.esc_html__( 'My Elementor Widget', 'ntshka-addons' ).'</strong>',
            '<strong>'.esc_html__( 'Elementor', 'ntshka-addons' ).'</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

    

    /**
    * Admin Notice
    * Warning when the site doesn't have a minimum required PHP version.
    * @since 1.0.0
    */
    public function admin_notice_minimum_php_version() {
        if( isset( $_GET[ 'activate' ] ) ) unset( $_GET[ 'activate' ] );
        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater', 'ntshka-addons' ),
            '<strong>'.esc_html__( 'ntshka-addons', 'ntshka-addons' ).'</strong>',
            '<strong>'.esc_html__( 'PHP', 'ntshka-addons' ).'</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dimissible"><p>%1$s</p></div>', $message );
    }

}


ntshka_addons::instance();
