<?php
/**
 * Plugin Name: Steam GameLibrary For WordPress
 * Plugin URI: https://www.azimiao.com
 * Description: Steam 游戏库列表，后台发布页面时选择“Steam库”即可
 * Version: 0.0.1b3
 * Author: 菜鸟生物圈
 * Author URI: https://github.com/Noob-Biosphere
 */

 
define('SG4WP_VERSION', '0.0.1b3');
define('SG4WP_PLUGIN_URL', plugins_url('', __FILE__));
define('SG4WP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SG4WP_PLUGIN_FILE', __FILE__);


include(SG4WP_PLUGIN_DIR . "SteamGameListConfig.php");
include_once(SG4WP_PLUGIN_DIR . "SG4WP_ImportTemplate.php");
include_once(SG4WP_PLUGIN_DIR . "API/json/GetSteamDataAPI.php");

register_activation_hook( __FILE__, "zm_sg4wp_install");

function zm_sg4wp_install(){
    update_option("zm_sg4wp_id", "your_steam_id");
    update_option("zm_sg4wp_key", "your_steam_web_api_key");
    update_option("zm_sg4wp_type", "3");
    update_option( "zm_sg4wp_apitype","1");
    update_option( "zm_sg4wp_cachetime", 86400);
    update_option("zm_sg4wp_thirdapi","");
}


function zm_sg4wp_plugin_action_links($links, $file)
{
    if (plugin_basename(__FILE__) !== $file) {
        return $links;
    }
    $settings_link = '<a href="admin.php?page=zm_sg4wp_setting">' . esc_html__('设置') . '</a>';

    array_unshift($links, $settings_link);

    return $links;
}



if(is_admin()){
    add_action( "admin_menu","zm_sg4wp_menu");
    add_filter('plugin_action_links', 'zm_sg4wp_plugin_action_links', 11, 3);
}

add_action( "plugins_loaded", "sg4wp_register_page");

?>