<?php
/**
 Plugin Name: 								MultiMediaMonster Cookie law authorization
 Plugin URI: 								http://www.multimediamonster.nl
 Description: 								Show a floating box on every page that make visitors required to choose a qookie level. After choosing and authorizing a level the information is logged in the database.
 Version: 									1.1
 Author: 									MultiMediaMonster, Renske van der Heijden
 Author URI: 								http://www.multimediamonster.nl
 License: 									GPLv2 or later
*/

// ---------------------------------------------------------------------------------------------------------------------
// 	PRE DEFINED VARIABLES
// 	@since									MultiMediaMonster 1.1
// ---------------------------------------------------------------------------------------------------------------------

	define('MMM_PLUGIN_CREATOR',				'MultiMediaMonster');
	define('MMM_PLUGIN_CREATOR_AUTHOR',			'Renske van der Heijden');
	define('MMM_PLUGIN_CREATOR_URL',			'www.multimediamonster.nl');
	define('MMM_PLUGIN_CREATOR_EMAIL',			'renske@multimediamonster.nl');
	define('MMM_PLUGIN_NAME', 					'Cookie law authorization');
	define('MMM_PLUGIN_ID_LONG', 				'mmm_cookie_law_authorization');
	define('MMM_PLUGIN_ID_LONG_MINUS', 			str_replace('_', '-', MMM_PLUGIN_ID_LONG));
	define('MMM_PLUGIN_ID_SHORT', 				'mmm_cla');
	define('MMM_PLUGIN_ID_SHORT_MINUS',			str_replace('_', '-', MMM_PLUGIN_ID_SHORT));
	define('MMM_PLUGIN_PATH',					dirname( __FILE__ ));
	define('MMM_PLUGIN_FOLDER',					basename(MMM_PLUGIN_PATH));
	define('MMM_PLUGIN_URL',					plugins_url().'/'.MMM_PLUGIN_FOLDER);
	
	define('MMM_PLUGIN_TRANSLATE',				MMM_PLUGIN_ID_SHORT_MINUS.'-translated');
	define('MMM_PLUGIN_TEXTDOMAIN',				MMM_PLUGIN_FOLDER . '/languages/');

// ---------------------------------------------------------------------------------------------------------------------
// 	INSTALLING/ACTIVATING/DEACTIVATING/DELETING THE PLUGIN
// 	@since									MultiMediaMonster 1.1
// ---------------------------------------------------------------------------------------------------------------------
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	ADMIN & FRONTEND
	// ---------------------------------------------------------------------------------------------------------------------
		
		// includes
		include_once( 'classes/class-mmm-copyright.php' );
		include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-settings.php' );
		include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-register.php' );
		
		// ---------------------------------------------------------------------------------------------------------------------
		// 	ADMIN
		// ---------------------------------------------------------------------------------------------------------------------
			
			// includes
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-admin-functions.php' );	
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-admin-actions.php' );	
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-admin-menu-items.php' );
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-admin-pages-tabs.php' );	
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-admin-pages.php' );
		
			// registering
			register_activation_hook( __FILE__, array( MMM_PLUGIN_ID_SHORT.'_register', 'activate' ) );
			register_deactivation_hook( __FILE__, array( MMM_PLUGIN_ID_SHORT.'_register', 'deactivate' ) );
			register_uninstall_hook( __FILE__, array( MMM_PLUGIN_ID_SHORT.'_register', 'uninstall' ) );
		
			// actions
			add_action( 'admin_init', MMM_PLUGIN_ID_SHORT.'_register::load_this_plugin' );
			add_action( 'admin_menu', MMM_PLUGIN_ID_SHORT.'_admin_menu_items::add_admin_menu_items' );
			add_action( 'init', MMM_PLUGIN_ID_SHORT.'_register::plugin_load_textdomain' );
			add_action( 'init', MMM_PLUGIN_ID_SHORT.'_admin_actions::custom_admin_actions' );
			add_action( 'wp_ajax_admin_actions_ajax', MMM_PLUGIN_ID_SHORT.'_admin_actions::custom_admin_actions' );
		
			// filters
			add_filter( 'plugin_action_links', MMM_PLUGIN_ID_SHORT.'_settings::add_plugin_settings_link', 2, 2);
		
		// ---------------------------------------------------------------------------------------------------------------------
		// 	FRONTEND
		// ---------------------------------------------------------------------------------------------------------------------
		
			// includes	
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-frontend-functions.php' );	
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-frontend-actions.php' );
			include_once( 'classes/class-'.MMM_PLUGIN_ID_SHORT_MINUS.'-frontend-widget.php' );	
			
			// actions
			add_action( 'wp_head', MMM_PLUGIN_ID_SHORT.'_frontend_functions::add_ajax_url' );
			add_action( 'wp_ajax_insert_ip', MMM_PLUGIN_ID_SHORT.'_frontend_actions::insert_ip', 10 );		
			add_action( 'wp_ajax_nopriv_insert_ip', MMM_PLUGIN_ID_SHORT.'_frontend_actions::insert_ip', 10 );		
			add_action( 'wp_footer', MMM_PLUGIN_ID_SHORT.'_frontend_widget::show_widget' );
		