<?php
/*
 * Plugin Name:     Juicy Contact Button
 * Version:         1.3.1
 * Text Domain:     juicy-contact-button
 * Plugin URI:      https://yrokiwp.ru
 * Description:     The plugin displays a floating contact button with a flashing «Online» light and optional fields. If you want to place the widget in a specific location, just add the shortcode: [juicy-contact]
 * Author:          dmitrylitvinov
 * Author URI:     https://yrokiwp.ru
 *
 *
 * License:           GNU General Public License v3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


define('JUICY_CONTACT_BUTTON_VERSION', '1.3.1');
define('JUICY_CONTACT_BUTTON_PLUGIN_DIR', plugin_dir_path(__FILE__));
/*------------Страница админки*------------*/
if (is_admin() || (defined('WP_CLI') && WP_CLI)) {
    require_once(JUICY_CONTACT_BUTTON_PLUGIN_DIR . 'admin.php');
    add_action('init', array('JuicyContactButton', 'init'));
}
/*------------Страница админки------------*/




function add_link_yrokiwp_juicy_contactbutton_js() {
    $val = get_option( 'juicy_contact_button_option' );

    if(isset( $val['contactImg'])){ $contactImg = $val['contactImg'];}else{ $contactImg= 'whatsAppLogo';}
    if(isset( $val['contactType'])){ $contactType = $val['contactType'];}else{ $contactType= 'link';}
    if(isset( $val['contact_link'])){ $contactLink = $val['contact_link'];}else{ $contactLink= '';}
    if(isset( $val['contact_link_text'])){ $contactLinkText = $val['contact_link_text'];}else{ $contactLinkText= '';}
    if(isset( $val['contact_text'])){ $contactText = $val['contact_text']; $contactTextActive = 'true';}
    else{ $contactText= '';  $contactTextActive= 'false';}
    if(isset( $val['backgroundColor'])){ $backgroundColor = $val['backgroundColor'];}else{ $backgroundColor = 'blue';}
    if(isset( $val['pluginPosition'])){ $pluginPosition = $val['pluginPosition'];}else{ $pluginPosition = 'bottom-right';}
    if(isset( $val['branding'])){ $branding = 'true';}else{ $branding = 'false';}
    if(isset( $val['sticky'])){ $sticky = 'true';}else{ $sticky = 'false';}
    if(isset( $val['autoOpen'])){ $autoOpen = 'true';}else{ $autoOpen = 'false';}
    if(isset( $val['zIndex'])){ $zIndex = 'true';}else{ $zIndex = 'false';}
    if(isset($val['text_on_line'])){$text_on_line = $val['text_on_line'];}else{$text_on_line = 'Online';}
    if(isset( $val['shortcode'])){
        if($pluginPosition=='bottom-right' || $pluginPosition=='top-right' ){
            $shortPosition = 'display: flex;justify-content: end;';
        }else{
            $shortPosition = 'display: flex;justify-content: start;';
        }
        echo '<div class="juicy-shortcode" style="position: relative;'.$shortPosition.'"></div>';
        $shortcode1 = 'initial';
    }else{
        add_action( 'wp_footer', 'add_link_yrokiwp_juicy_contactbutton_js' );
        $shortcode1 = 'fixed';}


 ?>
 <script>
     const head = document.head;
     const body = document.body;


     const whatsAppLogo =  `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.27421 0.0313252C5.19039 0.216734 3.2086 1.25537 1.84966 2.87429C1.11559 3.74876 0.511761 4.92708 0.235837 6.02339C0.0603115 6.72084 -0.000897114 7.22273 9.91323e-06 7.95677C0.00091694 8.66857 0.0351963 9.03297 0.155956 9.61444C0.37211 10.6554 0.75378 11.5683 1.34363 12.4554L1.50652 12.7003L1.01097 14.1861C0.681938 15.1728 0.530965 15.666 0.561585 15.6543C0.696544 15.6025 3.54545 14.6969 3.57345 14.6969C3.59165 14.6969 3.73465 14.7746 3.89125 14.8696C5.98967 16.142 8.6684 16.3554 10.9588 15.4327C12.7909 14.6945 14.2988 13.293 15.1651 11.5231C15.552 10.7326 15.7627 10.0589 15.905 9.15698C16.0066 8.5134 16.0066 7.49397 15.905 6.85038C15.7627 5.94852 15.552 5.27478 15.1651 4.48426C13.7126 1.5165 10.5622 -0.261238 7.27421 0.0313252ZM5.50047 3.72027C5.5518 3.74544 5.6252 3.82301 5.66361 3.89263C5.77399 4.09274 6.52075 5.90423 6.53886 6.01582C6.5631 6.16505 6.4419 6.37301 6.11256 6.74742C5.7819 7.12337 5.72351 7.22079 5.75175 7.34944C5.80173 7.57701 6.55697 8.57986 6.97508 8.97389C7.63549 9.59624 8.7035 10.2372 9.15216 10.2805C9.4218 10.3065 9.51344 10.2308 9.97924 9.59777C10.3502 9.09365 10.4509 9.04961 10.8596 9.21309C11.2462 9.36776 12.6941 10.0888 12.7538 10.1564C12.8716 10.2899 12.7728 11.0728 12.5932 11.4285C12.499 11.6152 12.2635 11.8527 11.994 12.0329C11.3989 12.431 10.7769 12.5591 10.0807 12.427C9.50437 12.3177 8.44427 11.9375 7.80745 11.6117C6.57758 10.9825 5.41446 9.90215 4.34389 8.39464C3.84874 7.69739 3.55734 7.11442 3.41362 6.53367C3.33505 6.21628 3.32358 5.66543 3.38851 5.32952C3.48068 4.8528 3.72567 4.38887 4.07209 4.03504C4.2686 3.83433 4.37166 3.7715 4.61678 3.70303C4.8268 3.64433 5.36711 3.6549 5.50047 3.72027Z" fill="white"/></svg>`;

     const telegramLogo = `<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.22556 0.531145C6.864 0.648208 5.47271 1.10601 4.30757 1.82032C3.1267 2.54426 1.97126 3.70635 1.29069 4.85447C-0.333564 7.59466 -0.43005 10.8707 1.03099 13.6723C2.69176 16.857 6.18913 18.7825 9.7381 18.4662C11.914 18.2722 13.8221 17.383 15.3509 15.8504C16.9429 14.2546 17.8162 12.3283 17.9763 10.059C18.0602 8.87053 17.8705 7.53482 17.4587 6.41474C17.265 5.88795 16.8097 4.99007 16.5071 4.53789C15.8016 3.48393 14.8399 2.5411 13.7977 1.88163C13.3991 1.62939 12.5317 1.20278 12.0823 1.03802C10.9012 0.604943 9.50362 0.421257 8.22556 0.531145ZM14.3336 5.17354C14.5008 5.25445 14.6275 5.42747 14.6275 5.57486C14.6275 5.6533 12.9847 12.9914 12.8653 13.4465C12.7817 13.7648 12.453 13.953 12.1571 13.852C12.0745 13.8238 11.4081 13.3932 10.6762 12.895C9.35684 11.9969 9.34488 11.9898 9.26999 12.0537C9.22845 12.0891 8.90656 12.3901 8.5547 12.7225C7.87687 13.3627 7.77342 13.4289 7.55041 13.3649C7.30341 13.2941 7.27917 13.2433 6.764 11.719C6.49821 10.9325 6.26324 10.2715 6.24185 10.25C6.22047 10.2285 5.6094 10.05 4.88391 9.85319C3.68468 9.52789 3.55605 9.48586 3.46811 9.39042C3.27887 9.18504 3.36884 8.9451 3.67867 8.82917C3.79017 8.78741 6.13703 7.94134 8.89389 6.94901C11.6508 5.95665 13.9301 5.13608 13.9591 5.12549C14.0653 5.0868 14.1866 5.10235 14.3336 5.17354ZM12.3043 6.78408C12.2163 6.83522 10.9296 7.57352 9.44484 8.42476C7.21839 9.70123 6.74148 9.9877 6.7234 10.0595C6.70821 10.1196 6.81827 10.4987 7.08086 11.2906C7.44429 12.3866 7.49726 12.524 7.53993 12.4814C7.55037 12.4709 7.59871 12.1237 7.64728 11.7098C7.69589 11.296 7.74985 10.9233 7.76727 10.8816C7.78464 10.8399 8.87258 9.9279 10.1849 8.85492C11.4972 7.78193 12.5907 6.88018 12.6149 6.85102C12.6752 6.77831 12.6312 6.68277 12.5396 6.68735C12.4981 6.68942 12.3922 6.73297 12.3043 6.78408Z" fill="white"/></svg>`;


     // SETTINGS || НАСТРОЙКИ

     const languge = 'eng'; // LANGUAGE (ru, eng) || ЯЗЫК (ru, eng)

     const contactImg = <?php echo esc_attr($contactImg); ?>;

     const contactType = '<?php echo esc_attr($contactType); ?>'

     const contactLink = '<?php echo esc_url($contactLink); ?>';

     const contactLinkText = '<?php echo esc_attr($contactLinkText); ?>'

     const contactText = '<?php echo esc_attr($contactText); ?>';

     const contactTextActive = <?php echo esc_attr($contactTextActive); ?>;

     const backgroundColor = '<?php echo esc_attr($backgroundColor); ?>';

     const pluginPosition = '<?php echo esc_attr($pluginPosition); ?>';

     const branding = <?php echo esc_attr($branding); ?>;

     const sticky = <?php echo esc_attr($sticky); ?>;

     const autoOpen = <?php echo esc_attr($autoOpen); ?>;

     const zIndex = <?php echo esc_attr($zIndex); ?>;


     // SCRIPT STYLES (DON'T TOUCH) || СТИЛИ СКРИПТА (НЕ ТРОГАТЬ)
<?php if(empty( $val['no_mobile'])){
    $no_mobile = '';
}else{
    $no_mobile = '@media (max-width: 767px){.contact-popup-wrapper{display:none!important}}';
}?>

     const pluginStyles = `<style>*{padding: 0; margin: 0; -webkit-box-sizing: border-box; box-sizing: border-box;}.contact-popup-plugin{font-family: 'Inter', sans-serif; font-size: 16px; font-weight: 400; position: <?php echo $shortcode1; ?>; z-index: 250; -webkit-transition: all ease 1s; transition: all ease 1s; height: 55px; display: -webkit-box; display: -ms-flexbox; display: flex; width: 52px; max-width: 95%;}@media (max-width: 767px){.contact-popup-plugin{font-size: 12px; width: 90% !important; max-width: 90% !important; margin-left: -45%;}.contact-popup-plugin._top-left, .contact-popup-plugin._top-right{top: -55px !important;}.contact-popup-plugin._top-left .contact-popup-content, .contact-popup-plugin._top-right .contact-popup-content{border-radius: 0 0 30px 30px !important; width: 100%; min-height: 55px; -webkit-box-pack: center !important; -ms-flex-pack: center !important; justify-content: center !important;}.contact-popup-plugin._top-left._active, .contact-popup-plugin._top-right._active{top: 0px !important;}.contact-popup-plugin._top-left._active .contact-popup-content, .contact-popup-plugin._top-right._active .contact-popup-content{margin: 0 0 10px 0 !important;}.contact-popup-plugin._top-left, .contact-popup-plugin._bottom-left{left: 50% !important; margin-left: -45%;}.contact-popup-plugin._top-right, .contact-popup-plugin._bottom-right{right: 50% !important; margin-right: -45%;}.contact-popup-plugin._top-left, .contact-popup-plugin._top-right{-webkit-box-orient: vertical !important; -webkit-box-direction: reverse !important; -ms-flex-direction: column-reverse !important; flex-direction: column-reverse !important;}.contact-popup-plugin._top-left .contact-popup-button, .contact-popup-plugin._top-right .contact-popup-button{top: 10px !important;}.contact-popup-plugin._bottom-left, .contact-popup-plugin._bottom-right{-webkit-box-orient: vertical !important; -webkit-box-direction: normal !important; -ms-flex-direction: column !important; flex-direction: column !important;}.contact-popup-plugin._bottom-left .contact-popup-button, .contact-popup-plugin._bottom-right .contact-popup-button{bottom: 10px !important;}.contact-popup-plugin._bottom-left, .contact-popup-plugin._bottom-right{bottom: -3px !important;}.contact-popup-plugin._bottom-left .contact-popup-content, .contact-popup-plugin._bottom-right .contact-popup-content{width: 100%; min-height: 55px; -webkit-box-pack: center !important; -ms-flex-pack: center !important; justify-content: center !important; border-radius: 30px 30px 0 0 !important;}.contact-popup-plugin._bottom-left._active, .contact-popup-plugin._bottom-right._active{bottom: 59px !important;}.contact-popup-plugin._bottom-left._active .contact-popup-content, .contact-popup-plugin._bottom-right._active .contact-popup-content{margin: 10px 0 0 0 !important;}}.contact-popup-plugin a{text-decoration: none; color: inherit; font-weight: inherit;}.contact-popup-plugin._sticky._autoopen._bottom-left, .contact-popup-plugin._sticky._autoopen._bottom-right{bottom: 10px !important;}.contact-popup-plugin._sticky .contact-popup-content{padding: 0 !important;}.contact-popup-plugin._sticky._active .contact-popup-content{padding: 12px 24px !important;}.contact-popup-plugin._sticky._top-left, .contact-popup-plugin._sticky._top-right{-webkit-box-orient: vertical !important; -webkit-box-direction: reverse !important; -ms-flex-direction: column-reverse !important; flex-direction: column-reverse !important;}.contact-popup-plugin._sticky._top-left .contact-popup-content, .contact-popup-plugin._sticky._top-right .contact-popup-content{margin: 0 0 10px 0 !important;}.contact-popup-plugin._sticky .contact-popup-plugin._sticky._top-left, .contact-popup-plugin._sticky._bottom-left{left: 20px;}@media (max-width: 767px){.contact-popup-plugin._sticky .contact-popup-plugin._sticky._top-left, .contact-popup-plugin._sticky._bottom-left{left: 50% !important; margin-left: -45%;}}.contact-popup-plugin._sticky._top-right, .contact-popup-plugin._sticky._bottom-right{right: 20px;}@media (max-width: 767px){.contact-popup-plugin._sticky._top-right, .contact-popup-plugin._sticky._bottom-right{right: 50% !important; margin-right: -45%;}}.contact-popup-plugin._sticky._bottom-left, .contact-popup-plugin._sticky._bottom-right{-webkit-box-orient: vertical !important; -webkit-box-direction: normal !important; -ms-flex-direction: column !important; flex-direction: column !important; width: auto;}.contact-popup-plugin._sticky._bottom-left .contact-popup-content, .contact-popup-plugin._sticky._bottom-right .contact-popup-content{border-radius: 30px 30px 0 0; min-height: 55px; max-height: 55px; width: 100%;}.contact-popup-plugin._sticky._bottom-left._active, .contact-popup-plugin._sticky._bottom-right._active{bottom: 60px;}.contact-popup-plugin._sticky._bottom-left._active .contact-popup-content, .contact-popup-plugin._sticky._bottom-right._active .contact-popup-content{margin: 10px 0 0 0 !important;}.contact-popup-plugin._sticky._top-left, .contact-popup-plugin._sticky._top-right{-webkit-box-orient: vertical; -webkit-box-direction: reverse; -ms-flex-direction: column-reverse; flex-direction: column-reverse; top: 0; width: auto;}.contact-popup-plugin._sticky._top-left .contact-popup-content, .contact-popup-plugin._sticky._top-right .contact-popup-content{border-radius: 0 0 30px 30px; min-height: 0; max-height: 0; width: 100%;}.contact-popup-plugin._sticky._top-left._active .contact-popup-content, .contact-popup-plugin._sticky._top-right._active .contact-popup-content{min-height: 55px; margin: 0 0 10px 0;}.contact-popup-plugin._sticky._top-left .contact-popup-content, .contact-popup-plugin._sticky._top-right .contact-popup-content{margin: 0;}@media (max-width: 767px){.contact-popup-plugin._sticky._top-left, .contact-popup-plugin._sticky._top-right{top: 0 !important;}}.contact-popup-plugin._top-left, .contact-popup-plugin._bottom-left{-webkit-box-align: start; -ms-flex-align: start; align-items: flex-start; -webkit-box-pack: left; -ms-flex-pack: left; justify-content: left; left: 20px;}@media (min-width: 768px){.contact-popup-plugin._top-left, .contact-popup-plugin._bottom-left{-webkit-box-orient: horizontal !important; -webkit-box-direction: normal !important; -ms-flex-direction: row !important; flex-direction: row !important;}}.contact-popup-plugin._top-left .contact-popup-content, .contact-popup-plugin._bottom-left .contact-popup-content{margin: 0 0 0 10px !important;}.contact-popup-plugin._top-left, .contact-popup-plugin._top-right{top: 20px;}.contact-popup-plugin._bottom-left, .contact-popup-plugin._bottom-right{bottom: 20px;}.contact-popup-plugin._top-right, .contact-popup-plugin._bottom-right{right: 20px; -webkit-box-align: end; -ms-flex-align: end; align-items: flex-end; -webkit-box-pack: right; -ms-flex-pack: right; justify-content: right; -webkit-box-orient: horizontal; -webkit-box-direction: reverse; -ms-flex-direction: row-reverse; flex-direction: row-reverse;}.contact-popup-plugin._black{color: #fff;}.contact-popup-plugin._black .contact-popup-button, .contact-popup-plugin._black .contact-popup-content{background-color: #191919;}.contact-popup-plugin._black .contact-popup-online, .contact-popup-plugin._black .contact-popup-branding{border-left: 2px solid rgba(255, 255, 255, 0.1);}.contact-popup-plugin._black .contact-popup-text{border-right: 2px solid rgba(255, 255, 255, 0.1);}.contact-popup-plugin._white{color: #191919;}.contact-popup-plugin._white .contact-popup-button, .contact-popup-plugin._white .contact-popup-content{background-color: #fff;}.contact-popup-plugin._white .contact-popup-button svg path, .contact-popup-plugin._white .contact-popup-content svg path{fill: #191919;}.contact-popup-plugin._white .contact-popup-online, .contact-popup-plugin._white .contact-popup-branding{border-left: 2px solid rgba(25, 25, 25, 0.1);}.contact-popup-plugin._white .contact-popup-text{border-right: 2px solid rgba(0, 0, 0, 0.1);}.contact-popup-plugin._white .contact-popup-button-close::before, .contact-popup-plugin._white .contact-popup-button-close::after{background-color: #191919;}.contact-popup-plugin._green{color: #fff;}.contact-popup-plugin._green .contact-popup-button, .contact-popup-plugin._green .contact-popup-content{background-color: #41BE36;}.contact-popup-plugin._green .contact-popup-online-orb{background-color: #fff;}.contact-popup-plugin._blue{color: #fff;}.contact-popup-plugin._blue .contact-popup-button, .contact-popup-plugin._blue .contact-popup-content{background-color: #0085ED;}.contact-popup-plugin._green .contact-popup-online, .contact-popup-plugin._green .contact-popup-branding, .contact-popup-plugin._blue .contact-popup-online, .contact-popup-plugin._blue .contact-popup-branding{border-left: 2px solid rgba(255, 255, 255, 0.5);}.contact-popup-plugin._green .contact-popup-text, .contact-popup-plugin._blue .contact-popup-text{border-right: 2px solid rgba(255, 255, 255, 0.5);}.contact-popup-plugin._green .contact-popup-button-close::before, .contact-popup-plugin._green .contact-popup-button-close::after, .contact-popup-plugin._blue .contact-popup-button-close::before, .contact-popup-plugin._blue .contact-popup-button-close::after, .contact-popup-plugin._black .contact-popup-button-close::before, .contact-popup-plugin._black .contact-popup-button-close::after{background-color: #fff;}.contact-popup-plugin._active{width: auto;}.contact-popup-plugin._active .contact-popup-button .contact-popup-button-close{-webkit-transform: rotate(0); transform: rotate(0); opacity: 1;}.contact-popup-plugin._active .contact-popup-button svg{-webkit-transform: rotate(-45deg); transform: rotate(-45deg); opacity: 0;}.contact-popup-plugin._active .contact-popup-content{padding: 18px 24px; margin: 0 10px 0 0; width: 100%;}.contact-popup-plugin._active .contact-popup-content .contact-popup-online{width: 100%;}@media (max-width: 767px){.contact-popup-plugin._active .contact-popup-content{width: 100%;}}.contact-popup-plugin._active._top-left .contact-popup-content, .contact-popup-plugin._active ._bottom-left .contact-popup-content{margin: 0 0 0 10px;}.contact-popup-plugin._branding .contact-popup-online{padding: 0 12px;}.contact-popup-plugin._branding .contact-popup-branding{display: -webkit-box; display: -ms-flexbox; display: flex;}.contact-popup-button{border-radius: 50%; height: 52px; width: 52px; min-width: 52px; min-height: 52px; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; cursor: pointer; position: relative;}.contact-popup-button .contact-popup-button-close{width: 16px; height: 16px; -webkit-transform: rotate(45deg); transform: rotate(45deg); opacity: 0;}.contact-popup-button .contact-popup-button-close::before, .contact-popup-button .contact-popup-button-close::after{content: ''; position: absolute; width: 100%; height: 2px; top: 8px; border-radius: 8px;}.contact-popup-button .contact-popup-button-close::before{-webkit-transform: rotate(45deg); transform: rotate(45deg);}.contact-popup-button .contact-popup-button-close::after{-webkit-transform: rotate(-45deg); transform: rotate(-45deg);}.contact-popup-button svg, .contact-popup-button .contact-popup-button-close{position: absolute; top: 50%; left: 50%; margin-top: -8px; margin-left: -8px; -webkit-transition: all ease .6s; transition: all ease .6s;}.contact-popup-button svg{-webkit-transform: rotate(0); transform: rotate(0); opacity: 1;}.contact-popup-content{height: 52px; border-radius: 50px; padding: 18px 0; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; width: 0; -webkit-transition: all ease .6s; transition: all ease .6s; overflow: hidden;}.contact-popup-connection{white-space: nowrap; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; padding: 0 12px; width: -webkit-fit-content I !important; width: -moz-fit-content I !important; width: fit-content I !important;}@media (max-width: 767px){.contact-popup-connection{padding: 0 12px 0 0;}}.contact-popup-connection._min{padding: 0 12px 0 0;}.contact-popup-connection svg{margin: 0 12px 0 0;}@-webkit-keyframes onlineAnim{0%{opacity: 1;}50%{opacity: 0;}100%{opacity: 1;}}@keyframes onlineAnim{0%{opacity: 1;}50%{opacity: 0;}100%{opacity: 1;}}.contact-popup-online{padding: 0 12px; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-transition: all ease .6s; transition: all ease .6s; font-weight: 300; width: -webkit-fit-content !important; width: -moz-fit-content !important; width: fit-content !important; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;}@media (max-width: 767px){.contact-popup-online{-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;}}.contact-popup-online._min{padding: 0 0 0 12px;}.contact-popup-online .contact-popup-online-orb{min-width: 6px; min-height: 6px; max-width: 6px; max-height: 6px; border-radius: 50%; background-color: #10CC00; -webkit-transition: all ease .2s; transition: all ease .2s; margin: 0 6px 0 0; -webkit-animation: onlineAnim; animation: onlineAnim; -webkit-animation-duration: 1.8s; animation-duration: 1.8s; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite;}.contact-popup-branding{display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; padding: 0 0 0 12px; white-space: nowrap;}@media (max-width: 767px){.contact-popup-branding{display: none;}}.contact-popup-branding svg{margin: 0 10px 0 0;max-width:inherit;}.contact-popup-text{white-space: nowrap; padding: 0 12px 0 0;}.contact-popup-text._disabled{display: none;}@media (max-width: 767px){.contact-popup-text{display: none;}}<?php echo $no_mobile; ?></style>`

     const yrokiWpLogo = `<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.8"><g clip-path="url(#clip0_10_217)"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.00296 0.5L1.25403 4.36473L8.00296 8.22947L14.7519 4.36473L8.00296 0.5ZM8.16696 4.85695C8.24205 4.86997 8.31039 4.89343 8.36588 4.9252L8.94147 5.25482C9.11038 5.35155 9.38423 5.35155 9.5531 5.25482C9.72202 5.15812 9.72202 5.00129 9.5531 4.9046L8.97888 4.57575C8.92249 4.54348 8.88115 4.50363 8.85859 4.45984L8.13883 3.06273C8.03955 2.87002 7.61635 2.80834 7.36826 2.95041C7.24306 3.02211 7.20032 3.12847 7.25826 3.22429L7.90056 4.28686L6.0288 3.92708C5.8609 3.8948 5.67554 3.91974 5.55027 3.99147C5.30101 4.13421 5.4075 4.3776 5.74482 4.43619L8.16696 4.85695Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15.1724 4.90585L8.42346 8.77059V16.5001L15.1724 12.6353V4.90585ZM12.3083 8.78268C12.1312 8.78427 11.9146 8.85836 11.6587 9.00491L11.0555 9.3503C10.8692 9.457 10.7181 9.71656 10.7181 9.93001V12.7489C10.7181 12.9423 10.855 13.0207 11.0239 12.924C11.1928 12.8272 11.3297 12.592 11.3297 12.3986V12.0097C11.3297 11.7963 11.4808 11.5367 11.6672 11.43L11.7684 11.3721C11.9709 11.2561 12.141 11.1232 12.2788 10.9735C12.4194 10.8189 12.5305 10.6587 12.612 10.4928C12.6964 10.3253 12.7568 10.1587 12.7934 9.99281C12.8328 9.8221 12.8525 9.66431 12.8525 9.51938C12.8525 9.27463 12.806 9.09024 12.7132 8.96626C12.6205 8.83903 12.4855 8.77785 12.3083 8.78268ZM11.9962 10.5073C11.9343 10.5782 11.857 10.6402 11.7642 10.6933L11.6672 10.7489C11.4808 10.8556 11.3297 10.769 11.3297 10.5556V10.2561C11.3297 10.0427 11.4808 9.78311 11.6672 9.6764L11.7684 9.61843C11.8753 9.55722 11.9596 9.52985 12.0215 9.53631C12.0862 9.54114 12.134 9.56529 12.1649 9.60877C12.1958 9.65225 12.2155 9.70214 12.224 9.75853C12.2352 9.81005 12.2408 9.85352 12.2408 9.88896C12.2408 9.93403 12.2324 9.992 12.2155 10.0629C12.2015 10.1321 12.1761 10.2062 12.1396 10.2851C12.1058 10.3591 12.058 10.4332 11.9962 10.5073Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M7.73013 8.77059L0.981201 4.90585L0.981201 12.6353L7.73013 16.5001V8.77059ZM2.7249 8.30052C2.53522 8.19188 2.40469 8.3353 2.47314 8.57708L3.35079 11.6775C3.43665 11.9808 3.74677 12.1703 3.84726 11.9808L4.42818 10.8855C4.43256 10.8773 4.43636 10.8685 4.4396 10.8592L4.91826 12.5002C5.0101 12.8151 5.33573 12.9969 5.42181 12.7813L6.24058 10.7308C6.30623 10.5664 6.17582 10.2766 5.98758 10.1689L5.91806 10.129C5.79926 10.061 5.69444 10.0899 5.6598 10.2002L5.19281 11.6879L4.56315 9.54632C4.52188 9.40595 4.4229 9.27285 4.31293 9.20989L4.28659 9.19478C4.09549 9.08537 3.9649 9.23173 4.03602 9.47559L4.29108 10.35C4.16044 10.201 3.98271 10.1512 3.91833 10.2979L3.65808 10.8908L3.11028 8.7309C3.07308 8.58423 2.9703 8.44104 2.85468 8.37484L2.7249 8.30052Z" fill="white"/></g></g><defs><clipPath id="clip0_10_217"><rect x="0.981201" y="0.5" width="14.2222" height="16" fill="white"/></clipPath></defs></svg>`

     const interFont = `<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap" rel="stylesheet">`;


     const connectionPaddingRemove = () => {
         if(contactTextActive === false || contactText === '') {
             return '_min';
         }
         return '';
     }

     head.innerHTML += interFont + pluginStyles;
     <?php
     if(isset( $val['shortcode'])){


     ?>
     const shortcodeblock = document.querySelector('.juicy-shortcode');
     shortcodeblock.innerHTML += `<div class="contact-popup-wrapper" style="<?php echo $shortPosition; ?>"></div>`;
     <?php
     }else{
         ?>
     body.innerHTML += `<div class="contact-popup-wrapper"></div>`;
         <?php
     }
     ?>


     const contactPopupWrapper = document.querySelector('.contact-popup-wrapper');

     contactPopupWrapper.innerHTML += `<div style="z-index: ${zIndex}" class="contact-popup-plugin _${backgroundColor} _${pluginPosition} ${sticky ? '_sticky' : ''} ${autoOpen ? '_active' : ''}">
                                          <div class="contact-popup-button" ${autoOpen ? 'style="display: none;"' : ''}>${contactImg}<div class="contact-popup-button-close"></div></div>
                                          <a href="${contactType === "phone" ? 'tel:' : ''}${contactLink}" ${contactType === "link" ? 'target="_blank" rel="nofollow"' : ""} class="contact-popup-content">
                                            ${contactTextActive === true ? `<div class="contact-popup-text">${contactText}</div>` : ''}
                                            <div class="contact-popup-connection ${connectionPaddingRemove()}">
                                                ${contactImg} ${contactLinkText}
                                            </div>
                                            <div class="contact-popup-online ${branding === false ? '_min' : ''}">
                                                <div class="contact-popup-online-orb"></div> <?php echo esc_attr($text_on_line); ?>
                                            </div>
                                            ${branding === true ? `<div class="contact-popup-branding">${yrokiWpLogo} by YWP</div>` : ''}
                                          </a>
                                      </div>`;



     const contactButton = document.querySelector('.contact-popup-button');
     const contactPlugin = document.querySelector('.contact-popup-plugin');
     const contactPluginContent = document.querySelector('.contact-popup-content');

     if(contactPlugin.classList.contains('_sticky'))
     {
         contactPluginContent.style.width = '0';
     }

     contactButton.addEventListener('click', () => {
         contactPlugin.classList.toggle('_active');
         if(window.innerWidth > 767) {
             if(contactPlugin.classList.contains('_active')) {
                 contactPluginContent.style.width = '100%';
             }
             else {
                 contactPlugin.classList.add('_active');
                 contactPluginContent.style.width = '0%';
                 setTimeout(() => contactPlugin.classList.remove('_active'), 500)
             }
         }
         else {
             if(sticky) {
                 contactPluginContent.style.width = '100%';
             }
         }

     })

     if (contactText === '' || contactTextActive === false) {
         document.querySelector('.contact-popup-text').style.display = 'none';
     }

     if(autoOpen) {
         contactPlugin.classList.add('_autoopen')
         contactPluginContent.style.width = '100%';
     }
 </script>
<?php
}

add_shortcode( 'juicy-contact', 'add_link_yrokiwp_juicy_contactbutton_js' );

$val = get_option( 'juicy_contact_button_option' );
if(empty( $val['shortcode'])){
    add_action( 'wp_footer', 'add_link_yrokiwp_juicy_contactbutton_js' );
}
