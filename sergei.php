<?php
/**
 * Plugin name: Sergei Teateriba
 */
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function() {
    add_options_page('Teateriba', 'Sergei teateriba', 'manage_options', 's-teateriba', 's_teateriba_html');
});

add_action('admin_init', function() {
    register_setting('s_opt', 'tr_t');
    register_setting('s_opt', 'tr_b');
});

function s_teateriba_html() {
    ?>
    <div class="wrap">
        <h1>Seaded</h1>
        <form method="post" action="options.php">
            <?php 
            settings_fields('s_opt');
            do_settings_sections('s_opt'); // Lisatud kindluse mõttes
            ?>
            Tekst: <input type="text" name="tr_t" value="<?php echo esc_attr(get_option('tr_t')); ?>"><br>
            Varv: <input type="color" name="tr_b" value="<?php echo esc_attr(get_option('tr_b', '#ff0000')); ?>"><br>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_action('wp_footer', function() {
    $t = get_option('tr_t');
    if (empty($t)) return;
    $b = get_option('tr_b', '#ff0000');
    echo "<div style='position:fixed; top:0; left:0; width:100%; background:$b; color:#fff; text-align:center; padding:10px; z-index:9999;'>$t</div>";
});
