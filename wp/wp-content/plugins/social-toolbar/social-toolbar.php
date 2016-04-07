<?php
/*
Plugin Name: Social Toolbar
Plugin URI: http://socialtoolbarpro.com
Description: Now updated with a full web-based, management and customization engine! Social Toolbar will Add Social Power to your Website. Increase engagement, sharing and relationship building for your website and brand, by integrating all of your social content and community into one cohesive toolbar experience.
Version: 3.2
Author: DaddyDesign
Tags: footer, toolbar, social networking, social icons, tool bar, share, facebook like, tweet, recent tweet, facebook, twitter, settings, customize, colors, wibiya, social toolbar,google +1,google plusone, social feed, google share, feed, pinterest, meebo, instgram, hello bar, share bar
Author URI: http://www.daddydesign.com
*/

/*  Copyright 2014  socialtools.fm  (email : contact@socialtools.fm)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA   02110-1301  USA
*/

/*	GLOBAL VARIABLES */
if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

define('social_toolbar_PATH',WP_CONTENT_URL.'/plugins/social-toolbar/');

global $SocialToolsTDefaults;

$exclude_pages=array();

$SocialToolsTDefaults=array(
'home_page'=>1, 
'category_archive'=>1,
'blog_single_post'=>'blog_single_post');

error_reporting( E_ALL & ~( E_NOTICE | E_WARNING ) );

if (is_admin()) {
  add_action('admin_init', 'admin_init_social_toolbar');
  add_action('admin_menu', 'admin_menu_social_toolbar');
}

if (!is_admin()) {
	add_action('wp_footer', 'SocialTools_html_code_insert');
}

function social_toolbar_activation() {
	add_option('social_toolbar_code', '');
	add_option('social_toolbar_values', '');
}
register_activation_hook(__FILE__, 'social_toolbar_activation');

function social_toolbar_deactivation() {
}
register_deactivation_hook(__FILE__, 'social_toolbar_deactivation');

function admin_init_social_toolbar() {
  register_setting('social_toolbar', 'social_toolbar_code');
  register_setting('social_toolbar', 'social_toolbar_values');
}

function admin_menu_social_toolbar() {
  $level = 'level_7';
  add_menu_page('Social Toolbar', 'Social Toolbar', $level, __FILE__, 'options_page_social_toolbar',social_toolbar_PATH.'images/icon.png');
}

function options_page_social_toolbar() {
  include(WP_PLUGIN_DIR.'/social-toolbar/options.php');  
}

function social_toolbar() {
	$social_toolbar_code = get_option('social_toolbar_code');?>
	<script src="http://dashboard.socialtools.fm/socialfm.js?code=<?php echo $social_toolbar_code;?>" type="text/javascript"></script>
<?php }
  
function SocialTools_curPageURL() {
	$pageURL1 = 'http';
  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL1 .= "s";}
 	$pageURL1 .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  	$pageURL1 .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
  	$pageURL1 .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL1; 
}

/* Include HTML Code to footer */
function SocialTools_html_code_insert()
{
	global $SocialTools_SocialSettings,$SocialToolsSettings;
	$SocialTools_options=get_option('social_toolbar_values'); 
	$url = SocialTools_curPageURL();
	$home_url=get_bloginfo('url').'/';
	$display_code=0;
	$specific_pages=explode(',',$SocialTools_options['specific_pages']);
	$exclude_pages=explode(',',$SocialTools_options['exclude_pages']);
	$front_page=get_option('show_on_front');
	
	if($front_page=='page')
	{
		$blog_page=get_option('page_for_posts');
		$home_page=get_option('page_on_front');
	}
	else
	{
		$blog_page=get_option('page_for_posts');
		$home_page=get_option('page_on_front');
	}
	
	if($SocialTools_options['whole_website']=='true')
	{
		social_toolbar();
	}
	else
	{
		if($url==$home_url && array_key_exists('home_page', $SocialTools_options))
		{
			social_toolbar();
		}
		elseif(is_archive())
		{
			if(isset($SocialTools_options['category_archive']))
			{
				social_toolbar();
			}
			else
			{
			}						
		}
		elseif(is_singular() || $front_page=='page')
		{
			global $post,$posts;
			$page_id=$post->ID;
			if($page_id==$home_page || $page_id==$blog_page)
			{
				if($page_id==$home_page && isset($SocialTools_options['home_page']))
				{
					social_toolbar();
				}
				elseif($page_id==$blog_page && isset($SocialTools_options['blog_single_post']))
				{
					social_toolbar();
				}
				else
				{
				}
			}
			elseif(isset($SocialTools_options['blog_single_post']) || count($exclude_pages)>0 || count($specific_pages)>0)
			{
				if(in_array($page_id,$exclude_pages))
				{
				}
				elseif(in_array($page_id,$specific_pages))
				{
					social_toolbar();
				}
				elseif(isset($SocialTools_options['blog_single_post']))
				{
					social_toolbar();
				}
				else
				{
				}

			}
			else
			{
			}
		}
		else
		{
		}
	}
}
?>