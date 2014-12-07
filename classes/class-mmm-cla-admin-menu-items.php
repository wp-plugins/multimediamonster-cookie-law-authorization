<?php
class mmm_cla_admin_menu_items 
{

	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ADMIN MENU ITEMS
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function add_admin_menu_items ()
		{
			$admin_page 			= 	add_menu_page( '', MMM_PLUGIN_NAME, 'manage_options', MMM_PLUGIN_ID_LONG_MINUS.'-settings', array( MMM_PLUGIN_ID_SHORT.'_admin_pages', 'add_admin_page' ), MMM_PLUGIN_URL.'/images/admin/menu-icon.png', 100 );
			$submenu_pages 			= 	array(
											array(
												MMM_PLUGIN_ID_LONG_MINUS.'-settings',
												'',
												__('Authorized', MMM_PLUGIN_TRANSLATE),
												'manage_options',
												MMM_PLUGIN_ID_LONG_MINUS.'-authorized',
												array( MMM_PLUGIN_ID_SHORT.'_admin_pages', 'add_admin_page' )
											)
										);
			$submenu_pages 			= 	apply_filters( MMM_PLUGIN_ID_LONG, $submenu_pages );
			if (count($submenu_pages)) 
			{
				foreach ($submenu_pages as $submenu_page)
				{
					// Add submenu page
					$admin_page 	= 	add_submenu_page( $submenu_page[0], $submenu_page[2], $submenu_page[2], $submenu_page[3], $submenu_page[4], $submenu_page[5] );
				}
			}
			global $submenu;
			if (isset($submenu[MMM_PLUGIN_ID_LONG_MINUS.'-settings']))
			{
				$submenu[MMM_PLUGIN_ID_LONG_MINUS.'-settings'][0][0] = __('Settings', MMM_PLUGIN_TRANSLATE);
			}
			// load admin styles
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( MMM_PLUGIN_ID_LONG_MINUS.'-admin-styles', MMM_PLUGIN_URL . '/css/admin/style.css', array(), MMM_PLUGIN_ID_SHORT_MINUS );
			// load admin scripts
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( MMM_PLUGIN_ID_LONG_MINUS.'-admin-scripts-header', MMM_PLUGIN_URL . '/js/admin/scripts-header.js', array( 'jquery' ), MMM_PLUGIN_ID_SHORT_MINUS, false );
			wp_enqueue_script( MMM_PLUGIN_ID_LONG_MINUS.'-admin-scripts-footer', MMM_PLUGIN_URL . '/js/admin/scripts-footer.js', array( 'jquery' ), MMM_PLUGIN_ID_SHORT_MINUS, true );
			
			wp_register_script( MMM_PLUGIN_ID_LONG_MINUS.'-google-api', "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false");
			wp_enqueue_script( MMM_PLUGIN_ID_LONG_MINUS.'-google-api');
			// translate
			$translated_for_js 					= mmm_cla_admin_functions::translated_texts();
			wp_localize_script( MMM_PLUGIN_ID_LONG_MINUS.'-admin-scripts-header', 'translated_for_js', $translated_for_js );
			wp_localize_script( MMM_PLUGIN_ID_LONG_MINUS.'-admin-scripts-footer', 'translated_for_js', $translated_for_js );
		}
}