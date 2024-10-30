<?php
/**
 * Class Juicy Contact Button
 * @version 2.4.0
 */
class JuicyContactButton{

    public static function init() {
        /* инициализируем меню в админке*/
        add_action( 'admin_menu', array( 'JuicyContactButton', 'add_admin_menu' ));

        add_action( 'admin_init', array( 'JuicyContactButton', 'plugin_settings' ));

    }

    public static function plugin_settings() {
        register_setting( 'option_group_juicy_contact_button', 'juicy_contact_button_option', 'sanitize_callback' );
        $trans1  = __( 'Plugin settings', 'juicy-contact-button' );
        $number_indents  = __( 'The number of indents after the copied text.', 'juicy-contact-button' );
        $contact_img = __( 'Contact image', 'juicy-contact-button' );
        $contact_type = __( 'Contact type', 'juicy-contact-button' );
        $contact_link = __( 'Contact link', 'juicy-contact-button' );
        $contact_link_text = __( 'Contact link text', 'juicy-contact-button' );
        $contact_text = __( 'Contact text', 'juicy-contact-button' );
        $backgroundColor = __('Background color', 'juicy-contact-button' );
        $pluginPosition  = __('Position', 'juicy-contact-button' );


        // параметры: $id, $title, $callback, $page
        add_settings_section( 'section_id', $trans1, '', 'section_juicy_contact_button_1' );
        // параметры: $id, $title, $callback, $page, $section, $args

        add_settings_field( 'primer_field0', $contact_img, array( 'JuicyContactButton', 'contact_img' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field1', $contact_type, array( 'JuicyContactButton', 'contactType' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field2', $contact_link, array( 'JuicyContactButton', 'contact_link' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field3', $contact_link_text, array( 'JuicyContactButton', 'contact_link_text' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field4', $contact_text, array( 'JuicyContactButton', 'contact_text' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field5', $backgroundColor, array( 'JuicyContactButton', 'backgroundColor' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field6', $pluginPosition, array( 'JuicyContactButton', 'pluginPosition' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field7', __('Show plugin developer logo','juicy-contact-button'), array( 'JuicyContactButton', 'branding' ), 'section_juicy_contact_button_1', 'section_id' );


        add_settings_field( 'primer_field8', __('Sticky','juicy-contact-button'), array( 'JuicyContactButton', 'sticky' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field11', __('Text "Online"','juicy-contact-button'), array( 'JuicyContactButton', 'text_on_line' ), 'section_juicy_contact_button_1', 'section_id' );

        add_settings_field( 'primer_field9', __('Mode without button (always open)','juicy-contact-button'), array( 'JuicyContactButton', 'autoOpen' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field10', __('Set your z-index','juicy-contact-button'), array( 'JuicyContactButton', 'zIndex' ), 'section_juicy_contact_button_1', 'section_id' );
 add_settings_field( 'primer_field12', __('Only shortcode','juicy-contact-button'), array( 'JuicyContactButton', 'do_shortcode' ), 'section_juicy_contact_button_1', 'section_id' );
        add_settings_field( 'primer_field13', __('Only on desktop','juicy-contact-button'), array( 'JuicyContactButton', 'no_mobile' ), 'section_juicy_contact_button_1', 'section_id' );


    }


    /* инициализируем меню в админке*/
    public static function add_admin_menu() {

        $hello1 = __( 'Juicy contact button settings', 'juicy-contact-button' );
        add_options_page( ' ', $hello1, 'manage_options', 'juicy-contact-button-plugin-options', array( 'JuicyContactButton', 'juicy_contact_button_plugin_options' ) );
    }

    public static function juicy_contact_button_plugin_options() {
        ?>
        <div class="wrap">

            <h2><?php echo _e( 'Juicy Contact Button', 'juicy-contact-button' ), ' V', JUICY_CONTACT_BUTTON_VERSION; ?></h2>

            <hr>


            <form action="options.php" method="POST">
                <?php
                settings_fields( 'option_group_juicy_contact_button' );     // скрытые защитные поля
                do_settings_sections( 'section_juicy_contact_button_1' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
                submit_button();
                ?>
            </form>

        </div>
        <?php
    }


    public static function contact_img() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['contactImg'])){ $val = $val['contactImg'];}else{ $val= 'whatsAppLogo';}
        ?>
      <label>WhatsApp <input type="radio" name="juicy_contact_button_option[contactImg]" value="whatsAppLogo" <?php checked('whatsAppLogo', $val); ?> /></label>
      <label>Telegram   <input type="radio" name="juicy_contact_button_option[contactImg]" value="telegramLogo" <?php checked('telegramLogo', $val); ?> /></label>
        <?php
    }

    public static function contactType() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['contactType'])){ $val = $val['contactType'];}else{ $val= 'link';}
        ?>
        <label>link <input type="radio" name="juicy_contact_button_option[contactType]" value="link" <?php checked('link', $val); ?> /></label>
        <label>phone <input type="radio" name="juicy_contact_button_option[contactType]" value="phone" <?php checked('phone', $val); ?> /></label>
        <?php
    }



    public static function contact_link() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['contact_link'])){ $val = $val['contact_link'];}else{ $val='';}
        ?>
        <input type="text" placeholder="https://t.me/test" name="juicy_contact_button_option[contact_link]" value="<?php echo esc_attr( $val ) ?>" />
        <br><small><?php echo __( '(WhatsApp, Telegram or telephone)', 'juicy-contact-button' ); ?></small>
        <?php
    }


    public static function contact_link_text() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['contact_link_text'])){ $val = $val['contact_link_text'];}else{ $val='';}
        ?>
        <input type="text" placeholder="@name" name="juicy_contact_button_option[contact_link_text]" value="<?php echo esc_attr( $val ) ?>" />
        <br><small><?php echo __( 'Text to your link', 'juicy-contact-button' ); ?></small>
        <?php
    }


    public static function contact_text() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['contact_text'])){ $val = $val['contact_text'];}else{ $val='';}
        ?>
        <input type="text" placeholder="other text" name="juicy_contact_button_option[contact_text]" value="<?php echo esc_attr( $val ) ?>" />

        <?php
    }


    public static function backgroundColor() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['backgroundColor'])){ $val = $val['backgroundColor'];}else{ $val= 'blue';}
        ?>
        <label>blue <input type="radio" name="juicy_contact_button_option[backgroundColor]" value="blue" <?php checked('blue', $val); ?> /></label>
        <label>black <input type="radio" name="juicy_contact_button_option[backgroundColor]" value="black" <?php checked('black', $val); ?> /></label>
        <label>green <input type="radio" name="juicy_contact_button_option[backgroundColor]" value="green" <?php checked('green', $val); ?> /></label>
        <label>white <input type="radio" name="juicy_contact_button_option[backgroundColor]" value="white" <?php checked('white', $val); ?> /></label>

        <?php
    }

    public static function pluginPosition() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['pluginPosition'])){ $val = $val['pluginPosition'];}else{ $val= 'bottom-right';}
        ?>
        <label>Top-left <input type="radio" name="juicy_contact_button_option[pluginPosition]" value="top-left" <?php checked('top-left', $val); ?> /></label>
        <label>Top-right <input type="radio" name="juicy_contact_button_option[pluginPosition]" value="top-right" <?php checked('top-right', $val); ?> /></label>
        <label>Bottom-left <input type="radio" name="juicy_contact_button_option[pluginPosition]" value="bottom-left" <?php checked('bottom-left', $val); ?> /></label>
        <label>Bottom-right <input type="radio" name="juicy_contact_button_option[pluginPosition]" value="bottom-right" <?php checked('bottom-right', $val); ?> /></label>

        <?php
    }

public static function branding() {
        $val = get_option( 'juicy_contact_button_option' );
        $checked = isset($val['branding']) ? "checked" : "";
        ?>
        <input name="juicy_contact_button_option[branding]" type="checkbox" value="true" <?php echo $checked; ?>>
    <br><small><?php echo __( 'true - on, false - off', 'juicy-contact-button' ); ?></small>

<?php }


    public static function sticky() {
        $val = get_option( 'juicy_contact_button_option' );
        $checked = isset($val['sticky']) ? "checked" : "";
        ?>
        <input name="juicy_contact_button_option[sticky]" type="checkbox" value="true" <?php echo $checked; ?>>
        <br><small><?php echo __( 'Check if you want to enable', 'juicy-contact-button' ); ?></small>

    <?php }

    public static function text_on_line() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['text_on_line'])){ $val = $val['text_on_line'];}else{ $val='';}
        ?>
        <input type="text" placeholder="Online" name="juicy_contact_button_option[text_on_line]" value="<?php echo esc_attr( $val ) ?>" />
        <?php
    }



    public static function autoOpen() {
        $val = get_option( 'juicy_contact_button_option' );
        $checked = isset($val['autoOpen']) ? "checked" : "";
        ?>
        <input name="juicy_contact_button_option[autoOpen]" type="checkbox" value="true" <?php echo $checked; ?>>
        <br><small><?php echo __( 'Check if you want to enable', 'juicy-contact-button' ); ?></small>
    <?php }

    public static function zIndex() {
        $val = get_option( 'juicy_contact_button_option' );
        if(isset( $val['zIndex'])){ $val = $val['zIndex'];}else{ $val=50;}
        ?>
        <input type="text" placeholder="50" name="juicy_contact_button_option[zIndex]" value="<?php echo esc_attr( $val ) ?>" />

        <?php
    }

    public static function do_shortcode() {
        $val = get_option( 'juicy_contact_button_option' );
        $checked = isset($val['shortcode']) ? "checked" : "";
        ?>
        <input name="juicy_contact_button_option[shortcode]" type="checkbox" value="1" <?php echo $checked; ?>>
        <b><?php echo __( '[juicy-contact]', 'juicy-contact-button' ); ?></b>

    <?php }

    public static function no_mobile() {
        $val = get_option( 'juicy_contact_button_option' );
        $checked = isset($val['no_mobile']) ? "checked" : "";
        ?>
        <input name="juicy_contact_button_option[no_mobile]" type="checkbox" value="true" <?php echo $checked; ?>>

    <?php }


    ## Очистка данных
    public static function sanitize_callback( $options ) {
        // очищаем
        foreach ( $options as $name => & $val ) {
            $val = strip_tags( $val );
        }

        return $options;
    }

}