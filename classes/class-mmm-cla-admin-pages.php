<?php
class mmm_cla_admin_pages 
{
	// ---------------------------------------------------------------------------------------------------------------------
	// 	THE ADMIN PAGE:::ALL
	// 	@since									MultiMediaMonster 1.1
	// ---------------------------------------------------------------------------------------------------------------------
	
		static function add_admin_page ()
		{
			$to_administrate_array							= 	explode('-', $_GET['page']);
			$to_administrate 								= 	$to_administrate_array[count($to_administrate_array)-1];
			?>
			<div class="wrap <?php echo MMM_PLUGIN_ID_LONG_MINUS; ?>">
                <h2><?php echo MMM_PLUGIN_CREATOR; ?> &raquo; <?php echo MMM_PLUGIN_NAME; ?> &raquo; <?php _e('Settings', MMM_PLUGIN_TRANSLATE); ?></h2>

                <form method="post" action="admin.php?page=<?php echo MMM_PLUGIN_ID_LONG_MINUS.'-'.$to_administrate; ?>"> 
					<?php 
                    wp_nonce_field('handle_'.MMM_PLUGIN_ID_LONG, 'nonce_'.MMM_PLUGIN_ID_LONG); 
					$todo									= 	'';
                    if ($to_administrate == 'authorized')
					{
						$todo								= 	'delete-';
						global $wpdb;
						$query_to_run 						= 	"SELECT *
																FROM {$wpdb->prefix}".MMM_PLUGIN_ID_SHORT."
																ORDER BY 
																`date_time` DESC";
						$plugin_results 					= 	$wpdb->get_results( $query_to_run );
					}
					if ($to_administrate == 'settings')
					{
						$todo								= 	'edit-';
					}					
					?>                    
                    <input type="hidden" name="todo" value="<?php echo $todo.$to_administrate; ?>" />
                    
                    <input type="hidden" name="action" value="custom_admin_actions" />
                    <input type="hidden" name="handled_by" value="post" />
                    <div class="div-to-table">
                        <div class="div-to-row">
                            <div class="div-to-cell">
								<?php
								$messages 									= 	mmm_cla_admin_actions::custom_plugin_messages_create($to_administrate);
								$the_class									=	$messages['messages'][$_GET['message']][0];
								$the_message								=	$messages['messages'][$_GET['message']][1];
								mmm_cla_admin_actions::custom_admin_messages_show($the_message, $the_class);
                              	
								// show the tabs and content
								$options									=	array();
								$options['to_administrate']					=	$to_administrate;
								$options['plugin_results'] 					=	$plugin_results;
							    mmm_cla_admin_pages_tabs::display_tab_link($options);
								mmm_cla_admin_pages_tabs::display_tab_content($options);
                                ?>
                			</div>
							<?php mmm_copyright::copyright_column(); ?>
                        </div>
                    </div>
                </form>
            </div>
			<?
		}
}