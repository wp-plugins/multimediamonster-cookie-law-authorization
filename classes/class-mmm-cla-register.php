<?php
class mmm_cla_register 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU ACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function activate() 
		{
			add_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG, 'slug-'.MMM_CLA_PLUGIN_ID_LONG_MINUS );
		}
		static function load_this_plugin()
		{
			if ( is_admin() && get_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG ) == 'slug-'.MMM_CLA_PLUGIN_ID_LONG_MINUS )
			{
				delete_option( 'activated_'.MMM_CLA_PLUGIN_ID_LONG );
				add_action( 'init', self::create_table() );
			}
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU DEACTIVATE THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function deactivate() 
		{
		}
		
	// ---------------------------------------------------------------------------------------------------------------------
	// 	WHEN YOU UNINSTALL THE PLUGIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function uninstall() 
		{
			delete_option( MMM_CLA_PLUGIN_ID_SHORT.'_settings' );
			add_action( 'init', self::drop_table() );
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	LOADING THE TEXTDOMAIN
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function plugin_load_textdomain() 
		{
			load_plugin_textdomain( 'mmm-cla-translated', false, MMM_CLA_PLUGIN_TEXTDOMAIN ); 
		}
	
	// ---------------------------------------------------------------------------------------------------------------------
	// 	CREATING AND DROPPING TABLES
	// 	@since									MultiMediaMonster
	// ---------------------------------------------------------------------------------------------------------------------
		
		static function create_table ()
		{
			global $wpdb;
			$mmm_plugin_table_cols				= 	array
													(
														'`id` int(11) NOT NULL AUTO_INCREMENT', 
														'`ipaddress` varchar(255) NOT NULL', 
														'`date_time` datetime NOT NULL', 
														'`level` int(11) NOT NULL', 
														'PRIMARY KEY (`id`)'
													);
			$query_to_run 						= 	"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT." 
													(".join(', ', $mmm_plugin_table_cols).") DEFAULT CHARSET=utf8;";
			$wpdb->query( $query_to_run );
		}
		static function drop_table ()
		{
			global $wpdb;
			$query_to_run 						= 	"DROP TABLE IF EXISTS {$wpdb->prefix}".MMM_CLA_PLUGIN_ID_SHORT;
			$wpdb->query( $query_to_run );
		}
}