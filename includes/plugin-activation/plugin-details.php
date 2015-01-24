<?php
/**
 * This file contains the code that theme would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage SmartShop
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'smartshop_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function smartshop_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is used to install Soliloquy Slider plugin from WordPress Plugin Repository.
        array(
            'name'               => __('Soliloquy Lite','smartshop'), // The plugin name.
            'slug'               => 'soliloquy-lite', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),

        // This is to install Contact Form 7 from WordPress Plugin Repository.
        array(
            'name'      => __('Contact Form 7','smartshop'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

         // This is to install Envira Lite from WordPress Plugin Repository.
        array(
            'name'      => __('Envira Gallery','smartshop'),
            'slug'      => 'envira-gallery-lite',
            'required'  => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'smartshop' ),
            'menu_title'                      => __( 'Install Plugins', 'smartshop' ),
            'installing'                      => __( 'Installing Plugin: %s', 'smartshop' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'smartshop' ),
            'notice_can_install_required'     => _n_noop( __('This theme requires the following plugin: %1$s.','smartshop'), __('This theme requires the following plugins: %1$s.','smartshop')), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( __('This theme recommends the following plugin: %1$s.','smartshop'), __('This theme recommends the following plugins: %1$s.','smartshop')), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( __('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.','smartshop'), __('Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','smartshop')), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( __('The following required plugin is currently inactive: %1$s.','smartshop'), __('The following required plugins are currently inactive: %1$s.' ,'smartshop')), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( __('The following recommended plugin is currently inactive: %1$s.','smartshop'), __('The following recommended plugins are currently inactive: %1$s.' ,'smartshop')), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( __('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.','smartshop'), __('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','smartshop')), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( __('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.','smartshop'), __('The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ,'smartshop')), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( __('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.','smartshop'), __('Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','smartshop')), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( __('Begin installing plugin','smartshop'), __('Begin installing plugins','smartshop')),
            'activate_link'                   => _n_noop( __('Begin activating plugin','smartshop'), __('Begin activating plugins' ,'smartshop')),
            'return'                          => __( 'Return to Required Plugins Installer', 'smartshop' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'smartshop' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'smartshop' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}