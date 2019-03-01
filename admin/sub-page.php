<?php

add_action('admin_menu', 'smp_queries_settings_page');
function smp_queries_settings_page() {
    $parent_slug = 'page_cpt';
    $page_title = 'Settings';
    $menu_title = 'Settings';
    $capability = 'manage_options';
    $menu_slug = 'queries_settings';
    $function = 'page_options_callback_func';
    add_submenu_page(  $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
}

function page_options_callback_func(){
    ?>
    <form action="options.php" method="POST">
        <?php
        settings_fields( 'smp_option' );
        do_settings_sections( 'my_section' );
        submit_button();
        ?>
    </form>
    <?php
}

add_action('admin_init', 'create_section_and_fields');

function create_section_and_fields(){

    register_setting( 'smp_option', 'option_name', 'sanitize_callback' );

    add_settings_section( 'section_id', 'Queries settings', 'output_description_my_section', 'my_section' );

    add_settings_field('checkbox_id', 'Show queries', 'smp_checkbox_show_render', 'my_section', 'section_id' );
}

function output_description_my_section(){
    ?>
    <h4>This option allows you to hide 'Queries'</h4>
    <?php
}

function smp_checkbox_show_render(){
    $val = get_option("option_name");
    $val = $val ? $val['checkbox'] : null;
    ?>
    <label><input type="checkbox" name="option_name[checkbox]" value="1" <?php checked( 1, $val ) ?> /></label>
    <?php
}