<?php

if (!defined('ABSPATH')) {
    exit;
}

function zm_sg4wp_menu()
{
    add_menu_page(
        "Steam游戏库",
        "Steam游戏库",
        "administrator",
        "zm_sg4wp_setting",
        "zm_output_config_page",
        "dashicons-hammer",
        60
    );


    add_action("admin_init", "zm_sg4wp_config_data");
}

function zm_output_config_page()
{
?>
<div class="sg4wp">
    <h1>Steam游戏数据库模板设置</h1>
    <?php
        
        if (!empty($_REQUEST['settings-updated'])) {
            echo '<div id="message" class="updated fade"><p><strong>保存成功</strong></p></div>';
        }
        ?>
    <form action="options.php" method="post" class="sgMain">
        <?php settings_fields('zm-sg4wp'); ?>
        <?php do_settings_sections('zm-sg4wp'); ?>
        <table>
            <tr class="sg4wp">
                <th>Steam 64 位 ID:</th>
                <td><input type="text" name="zm_sg4wp_id" style="width: 300px"
                        value="<?php echo esc_attr(get_option('zm_sg4wp_id')); ?>"></td>
            </tr>
            <tr class="sg4wp">
                <th>Steam Web API Key:</th>
                <td><input type="text" name="zm_sg4wp_key" style="width: 300px"
                        value="<?php echo esc_attr(get_option('zm_sg4wp_key')); ?>"></td>
            </tr>
            <tr class="sg4wp">
                <th>顶栏卡片样式:</th>
                <td><select name="zm_sg4wp_cardtype">
                        <option value="1"
                            <?php echo esc_attr(get_option('zm_sg4wp_cardtype')) == "1" ?  'selected = "selected"' : "" ?>>
                            类型1</option>
                        <option value="2"
                            <?php echo esc_attr(get_option('zm_sg4wp_cardtype')) == "2" ?  'selected = "selected"' : "" ?>>
                            类型2</option>
                        <option value="3"
                            <?php echo esc_attr(get_option('zm_sg4wp_cardtype')) == "3" ?  'selected = "selected"' : "" ?>>
                            类型3</option>
                    </select>

                </td>
            </tr>
            <tr class="sg4wp">
                <th>STEAM API 接口:</th>
                <td>
                    <label>
                        <input type="radio" name="zm_sg4wp_apitype" value="1"
                            <?php echo esc_attr(get_option('zm_sg4wp_apitype')) == "1" ?  'checked = "checked"' : "" ?>>使用本地接口</label>
                    <label>
                        <input type="radio" name="zm_sg4wp_apitype" value="2"
                            <?php echo esc_attr(get_option('zm_sg4wp_apitype')) == "2" ?  'checked = "checked"' : "" ?>>使用第三方接口
                    </label>
                </td>
            </tr>
            <tr class="sg4wp">
                <th>三方接口地址:</th>
                <td><input type="text" name="zm_sg4wp_thirdapi" style="width: 300px"
                        value="<?php echo esc_attr(get_option('zm_sg4wp_thirdapi')); ?>"></td>
            </tr>
            <tr class="sg4wp">
                <th>缓存过期时间（秒）:</th>
                <td>
                    <input type="number" name="zm_sg4wp_cachetime"
                        value=<?php echo esc_attr(get_option('zm_sg4wp_cachetime'))?>>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php
    zm_sg4wp_config_style();
}

function zm_sg4wp_config_data()
{
    register_setting("zm-sg4wp", "zm_sg4wp_id");
    register_setting("zm-sg4wp","zm_sg4wp_key");
    register_setting("zm-sg4wp", "zm_sg4wp_cardtype");
    register_setting("zm-sg4wp", "zm_sg4wp_apitype");
    register_setting("zm-sg4wp", "zm_sg4wp_cachetime");
    register_setting("zm-sg4wp","zm_sg4wp_thirdapi");

}

function zm_sg4wp_config_style()
{
    wp_enqueue_style("sg4wp", plugins_url('/assets/css/sg4wp.css', __FILE__), false, SG4WP_VERSION, "all");
}
?>