<link rel="stylesheet" type="text/css" href="<?php echo social_toolbar_PATH;?>css/social_toolbar.css" />

<?php define('DD_SOCIAL_TOOLBAR_PATH',WP_CONTENT_URL.'/plugins/social-toolbar/');

function DDST_fetch_feed($feed='http://feeds2.feedburner.com/daddydesign',$count=5)
{
	include_once(ABSPATH . WPINC . '/feed.php'); // Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed($feed);
	
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
		$maxitems = $rss->get_item_quantity($count); // Figure out how many total items there are, but limit it to 5.   
		$rss_items = $rss->get_items(0, $maxitems); // Build an array of all the items, starting with element 0 (first element).
	endif;
	
	echo '<ol class="WPSOCIALTOOLBAR_latest_news">';
  
  if ($maxitems == 0) echo '<li>No items.</li>';
  else
    // Loop through each feed item and display each item as a hyperlink.
    foreach ( $rss_items as $item ) : 
    echo '<li>';
    echo '<a href="'.$item->get_permalink().'" title="">'.$item->get_title().'</a></li>';
  endforeach; 
	echo '</ol>';
} ?>

<script type="text/javascript">
	function fn_display_option(display_val)
	{
  	if(display_val == "false"){
  		jQuery(".display_options").show('slow');
  	}
  	else
  		{
    		jQuery(".display_options").hide('slow');
  		}
	}
</script>

<?php 
	$options=get_option('social_toolbar_values');
  $code=get_option('social_toolbar_code');
	$form_url=admin_url().'admin.php?page=social-toolbar/social-toolbar.php';?>

	<div class="wrap">
		<?php if( isset($_GET['settings-updated']) && ($code!='') ) { ?>
		  <div id="message" class="updated">
				<p><strong><?php _e('Social Toolbar settings saved.') ?></strong></p>
		  </div>
		<?php } else if($code==''){?>
		  <div id="message" class="updated">
		    <p><strong><?php _e('Please enter activation code.') ?></strong></p>
		  </div>
		<?php }?>
	
	  <h2>Social Toolbar</h2>
		
		<br />
		
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td width="70%" valign="top">
					<?php include_once dirname(__FILE__).'/go_pro_ad.php'; ?>
					<form method="post" action="options.php">
	        	<?php wp_nonce_field('update-options'); ?>
	        	<?php settings_fields('social_toolbar'); ?>
	        
	        	<table id="socialtools_page_options" class="form-table">
		        	<tr valign="top">
	    			    <th scope="row" class="actcode">Enter your Activation Code *</th>
		            <td>
		              <input type="text" name="social_toolbar_code" size="50" value="<?php echo get_option('social_toolbar_code'); ?>" />
		              <p class="description">Your activation code can be found within the Install section of <a href="http://dashboard.socialtools.fm/" target="_blank">http://dashboard.socialtools.fm/</a></p>
		            </td>
	            </tr>
		          
		          <tr>
				        <th scope="row" class="actcode"><?php _e('Display throughout entire website','Social Toolbar'); ?></th>
				        <td>
				        	<select name="social_toolbar_values[whole_website]" id="wpst_whole_website" onchange="fn_display_option(this.value);"><option value="true" <?php selected('true', $options['whole_website']); ?>>Yes</option><option value="false" <?php selected('false', $options['whole_website']); ?>>No</option></select>
				        </td>
		          </tr>
							
							<tr class="display_options" <?php if($options['whole_website'] == "true") {echo 'style="display:none"';}?>>             	
			        	<th scope="row"><?php _e('Display on home page ','WPSOCIALTOOLSOPTIONS'); ?></th>
			        	<td>
                 	<?php if(isset($options['home_page'])){
													$checked1="checked";
                    		}
                        else{
                        	$checked1="";
                        }
                  ?>
			        		<label><input type="checkbox" name="social_toolbar_values[home_page]" value="<?php echo $options['home_page']; ?>" size="30" <?php echo $checked1; ?> />  Yes</label>
								</td>
							</tr>
				
							<tr class="display_options" <?php if($options['whole_website'] == "true") {echo 'style="display:none"';}?>> 	
								<th scope="row"><?php _e('Display on category archive pages ','WPSOCIALTOOLSOPTIONS'); ?></th>
								<td>	
                	<?php if(isset($options['category_archive'])){
                         	$checked2="checked";
	                      }
	                      else{
	              	        $checked2="";
	                      }
	                ?>
									<label><input type="checkbox" name="social_toolbar_values[category_archive]" value="<?php echo $options['category_archive']; ?>" size="30" <?php echo $checked2; ?> />  Yes</label>
								</td>
							</tr>
							
							<tr class="display_options" <?php if($options['whole_website'] == "true") {echo 'style="display:none"';}?>>   	
				    		<th scope="row"><?php _e('Display on blog and single post pages ','WPSOCIALTOOLSOPTIONS'); ?></th>	
			        	<td>
                 	<?php if(isset($options['blog_single_post'])){
													$checked3="checked";
							  				}
							  				else{
							  					$checked3="";
							  				}
									?>                          
									<label><input type="checkbox" name="social_toolbar_values[blog_single_post]" value="<?php echo $options['blog_single_post']; ?>" size="30" <?php echo $checked3; ?> />  Yes</label>
                </td>
              </tr>
              
              <tr class="display_options" <?php if($options['whole_website'] == "true") {echo 'style="display:none"';}?>>
                <th scope="row"><?php _e('Display on specific pages','WPSOCIALTOOLSOPTIONS'); ?></th>
                <td>
                  <input type="text" name="social_toolbar_values[specific_pages]" value="<?php echo $options['specific_pages']; ?>" size="60" />
                  <p class="description"><?php _e('Comma separated list of post/page ID\'s (e.g. 5,9,43)','WPSOCIALTOOLSOPTIONS'); ?></p>
                </td>
              </tr>
              
              <tr class="display_options" <?php if($options['whole_website'] == "true") {echo 'style="display:none"';}?>>
                <th scope="row"><?php _e('Exclude specific pages','WPSOCIALTOOLSOPTIONS'); ?></th>
                <td>
                	<input type="text" name="social_toolbar_values[exclude_pages]" value="<?php echo $options['exclude_pages']; ?>" size="60" />
                	<p class="description"><?php _e('Comma separated list of post/page ID\'s (e.g. 5,9,43)','WPSOCIALTOOLSOPTIONS'); ?></p>
                </td>
              </tr>
        		</table>

        		<input type="hidden" name="update" value="update" id="update"/>
						<p class="submit">
							<input type="submit" class="button-primary" value="<?php _e('Save Configuration') ?>" name="code-save" id="code-save" />
	        	</p>

    			</form>
				</td>

				<td width="30%" valign="top">
					<?php include_once dirname(__FILE__).'/our_feeds.php'; ?>
				</td>
			</tr>
		</table>
	</div>