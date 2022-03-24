<?php
/*
Plugin Name: beGateway Payment
Plugin URI: https://github.com/begateway/wordpress-payment-plugin
Description: Place the plugin shortcode at any of your pages and start to accept payments in WordPress instantly
Version: 1.8.2
Author: beGateway Team
Author URI: https://begateway.com
License: MIT
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, 'bgt_activate' );
register_deactivation_hook( __FILE__, 'bgt_deactivate' );
register_uninstall_hook ( __FILE__, 'bgt_uninstall' );

function bgt_activate() {
    $args_set = array (
        //'currency' => 'USD',
        'pay_opt1' => 'Basic Service - $10',
        'pay_opt2' => 'Gold Service - $20',
        'pay_opt3' => 'Platinum Service - $30',
        'pay_opt_val1' => '10',
        'pay_opt_val2' => '20',
        'pay_opt_val3' => '30',
    );
    add_option( 'bgt_settings', $args_set );
}

function bgt_deactivate() {

}

function bgt_uninstall() {
		delete_option('bgt_settings');
}

function begateway_payment_init() {
	load_plugin_textdomain('begateway-payment', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('init', 'begateway_payment_init');

function bgt_head_html(){
  echo '<script>var bgt = ' . begateway_payment_init_var_json() . ';</script>';
}

add_action('wp_head', 'bgt_head_html');
/*-----------------------------------------------------------------------------------*/
/* Add Plugin Pages
/*-----------------------------------------------------------------------------------*/

function bgt_add_options_page(){
    add_options_page(__('beGateway Payment', 'begateway-payment'), __('beGateway Payment', 'begateway-payment'), 'manage_options', __FILE__, 'bgt_options_page');
}
add_action('admin_menu', 'bgt_add_options_page');

/*-----------------------------------------------------------------------------------*/
/*	Options
/*-----------------------------------------------------------------------------------*/
function bgt_register_settings() {
	register_setting( 'bgt_settings_group', 'bgt_settings' );
}
add_action( 'admin_init', 'bgt_register_settings' );

function bgt_options_page() {
    $bgt_settings = get_option('bgt_settings');
?>
	<div class="wrap"><div id="poststuff"><div id="post-body">

	<h2><?php _e('beGateway Payment Settings', 'begateway-payment'); ?></h2>

    <div class="postbox">
    <h3 class="hndle"><label for="title"><?php _e('Plugin Usage', 'begateway-payment'); ?></label></h3>
    <div class="inside">
        <p><?php _e('There are a few ways you can use this plugin:', 'begateway-payment');?></p>
        <ol>
            <li><?php _e('Configure the options below and then add the shortcode', 'begateway-payment'); ?> <strong>[begateway_payment]</strong> <?php _e('to a post or page', 'begateway-payment'); ?></li>
            <li><?php _e('Call the function from a template file', 'begateway-payment'); ?>: <strong>&lt;?php echo do_shortcode('[begateway_payment]'); ?&gt;</strong></li>
            <li><?php _e('Use the <strong>beGateway Payment</strong> Widget from the Widgets menu', 'begateway-payment'); ?></li>
        </ol>
        <h4><?php _e('Shortcode Parameters', 'begateway-payment'); ?></h4>
        <p><?php _e('Optionally, you can add some more parameters in the above mentioned shortcode to customize the currency code, reference title, return page URL, tax etc. Below is a list of the supported parameters in the payment button shortcode', 'begateway-payment'); ?></p>
        <ul>
          <li><strong>class</strong> - <?php _e('Form CSS class', 'begateway-payment');?></li>
          <li><strong>button_text</strong> - <?php _e('Title of proceed to payment button', 'begateway-payment');?></li>
          <li><strong>button_class</strong> - <?php _e('Payment button CSS class', 'begateway-payment');?></li>
          <li><strong>payment_subject</strong> - <?php _e('Product or service name or the reason for the payment here. The visitors will see this text', 'begateway-payment'); ?></li>
          <li><strong>other_amount</strong> - <?php _e('Set to 1 if you want to show ohter amount text box to your visitors so they can enter custom amount.', 'begateway-payment'); ?></li>
          <li><strong>other_amount_title</strong> - <?php _e('Title for the other amount text box. The visitors will see this text.', 'begateway-payment'); ?></li>
          <li><strong>text_box</strong> - <?php _e('Set to 1 if you want your visitors to be able to enter a reference text like email, web address or name.', 'begateway-payment'); ?></li>
          <li><strong>text_box_title</strong> - <?php _e('Title for the Reference text box (ie. your web address). The visitors will see this text.', 'begateway-payment'); ?></li>
          <li><strong>options</strong> - <?php _e('Payment options to show visitors. Usage sample: Product 1:10.00|Product 2:15.00', 'begateway-payment');?></li>
          <li><strong>type</strong> - <?php _e('Set to 1 if you want to show other amount text box to your visitors so they can enter custom amount.', 'begateway-payment'); ?></li>
          <li><strong>shop_id</strong> - <?php _e('This is your shop id found in your backoffice', 'begateway-payment'); ?></li>
          <li><strong>shop_key</strong> - <?php _e('This is your shop secret key found in your backoffice', 'begateway-payment'); ?></li>
          <li><strong>checkout_base</strong> - <?php _e('This is payment page domain of your payment service provide', 'begateway-payment'); ?></li>
          <li><strong>card</strong> - <?php _e('Set to 1 if you want to accept bankcard payments.', 'begateway-payment'); ?></li>
          <li><strong>halva</strong> - <?php _e('Set to 1 if you want to accept halva payments.', 'begateway-payment'); ?></li>
          <li><strong>erip</strong> - <?php _e('Set to 1 if you want to accept erip payments.', 'begateway-payment'); ?></li>
          <li><strong>erip_service_no</strong> - <?php _e('Your ERIP service code.', 'begateway-payment'); ?></li>
          <li><strong>personal_details</strong> - <?php _e('Set to 1 if you want your visitors to be required to enter personal name details during payment process.', 'begateway-payment'); ?></li>
          <li><strong>personal_email</strong> - <?php _e('Set to 1 if you want your visitors to be required to enter personal email details during payment process.', 'begateway-payment'); ?></li>
          <li><strong>personal_address</strong> - <?php _e('Set to 1 if you want your visitors to be required to enter personal address details during payment process.', 'begateway-payment'); ?></li>
          <li><strong>notification_url</strong> - <?php _e('Notification URL where beGateway will post messages about processed payments.', 'begateway-payment'); ?></li>
          <li><strong>success_url</strong> - <?php _e('Success URL where your customer will be redirected after a successful payment', 'begateway-payment'); ?></li>
          <li><strong>decline_url</strong> - <?php _e('Decline URL where your customer will be redirected after a payment error', 'begateway-payment'); ?></li>
          <li><strong>fail_url</strong> - <?php _e('Fail URL where your customer will be redirected after a failed payment', 'begateway-payment'); ?></li>
          <li><strong>cancel_url</strong> - <?php _e('Cancel URL where your customer will be redirected when a payment process is cancelled by the customer', 'begateway-payment'); ?></li>
          <li><strong>language</strong> - <?php _e('Payment page language. Use two letter code e.g. en for English', 'begateway-payment'); ?></li>
          <li><strong>currency</strong> - <?php _e('Currency code (USD, EUR and etc) for your visitors to make payments', 'begateway-payment'); ?></li>
        </ul>
    </div>
    </div>

        <form method="post" action="options.php">

			<?php settings_fields( 'bgt_settings_group' ); ?>

    <table class="form-table">
<?php
$shop_id = isset($bgt_settings['shop_id'] ) ? $bgt_settings['shop_id'] :'';
$shop_key = isset($bgt_settings['shop_key']) ? $bgt_settings['shop_key'] : '';
$checkout_base = isset($bgt_settings['checkout_base']) ? $bgt_settings['checkout_base'] : '';
$currency = isset($bgt_settings['currency']) ? $bgt_settings['currency'] : '';
$payment_subject = isset($bgt_settings['payment_subject']) ? $bgt_settings['payment_subject'] : '';
$other_amount = isset($bgt_settings['other_amount']) ? $bgt_settings['other_amount'] : '';
$other_amount_title = isset($bgt_settings['other_amount_title']) ? $bgt_settings['other_amount_title'] : '';
$card = isset($bgt_settings['card']) ? $bgt_settings['card'] : '1';
$halva = isset($bgt_settings['halva']) ? $bgt_settings['halva'] : '1';
$erip = isset($bgt_settings['erip']) ? $bgt_settings['erip'] : '';
$erip_service_no = isset($bgt_settings['erip_service_no']) ? $bgt_settings['erip_service_no'] : '99999999';
$text_box = isset($bgt_settings['text_box']) ? $bgt_settings['text_box'] : '';
$text_box_title = isset($bgt_settings['text_box_title']) ? $bgt_settings['text_box_title'] : '';
$personal_details = isset($bgt_settings['personal_details']) ? $bgt_settings['personal_details'] : '';
$personal_email = isset($bgt_settings['personal_email']) ? $bgt_settings['personal_email'] : '';
$personal_address = isset($bgt_settings['personal_address']) ? $bgt_settings['personal_address'] : '';
$notification_url = isset($bgt_settings['notification_url']) ? $bgt_settings['notification_url'] : '';
$success_url = isset($bgt_settings['success_url']) ? $bgt_settings['success_url'] : '';
$decline_url = isset($bgt_settings['decline_url']) ? $bgt_settings['decline_url'] : '';
$fail_url = isset($bgt_settings['fail_url']) ? $bgt_settings['fail_url'] : '';
$cancel_url = isset($bgt_settings['cancel_url']) ? $bgt_settings['cancel_url'] : '';
$bgt_settings_img = isset($bgt_settings['img']) ? $bgt_settings['img'] : '';
$test_mode = isset($bgt_settings['test_mode']) ? $bgt_settings['test_mode'] : '';
?>
<tr>
    <th><label for="shop_id"><?php _e('Shop Id', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="shop_id" class="regular-text" name="bgt_settings[shop_id]" value="<?php echo $shop_id; ?>" />
    <p class="description"><?php _e('This is your shop id found in your backoffice', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="shop_key"><?php _e('Shop Key', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="shop_key" class="regular-text" name="bgt_settings[shop_key]" value="<?php echo $shop_key; ?>" />
    <p class="description"><?php _e('This is your shop secret key found in your backoffice', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="checkout_base"><?php _e('Checkout Page Domain', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="checkout_base" class="regular-text" name="bgt_settings[checkout_base]" value="<?php echo $checkout_base; ?>" placeholder="checkout.domain.com"/>
    <p class="description"><?php _e('This is payment page domain of your payment service provider', 'begateway-payment'); ?></p>
    </td>
</tr>

<tr>
    <th><label for="currency"><?php _e('Choose Payment Currency', 'begateway-payment'); ?></label></th>
    <td>
		<select id="currency" name="bgt_settings[currency]">
			<option value="USD" <?php if ($currency=='USD') echo 'selected';?> >USD</option>
			<option value="EUR" <?php if ($currency=='EUR') echo 'selected';?> >EUR</option>
      <option value="RUB" <?php if ($currency=='RUB') echo 'selected';?> >RUB</option>
      <option value="BYN" <?php if ($currency=='BYN') echo 'selected';?> >BYN</option>
		</select>
    <p class="description"><?php _e('This is the currency for your visitors to make payments', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="payment_subject"><?php _e('Payment Subject', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="payment_subject" class="regular-text" name="bgt_settings[payment_subject]" value="<?php echo $payment_subject; ?>" />
    <p class="description"><?php _e('Enter the Product or service name or the reason for the payment here. The visitors will see this text', 'begateway-payment'); ?></p>
    </td>
</tr>

<?php
for ($d = 1; $d <= 6; $d++) {
    $bgt_settings['pay_opt'.$d] = isset($bgt_settings['pay_opt'.$d]) ? $bgt_settings['pay_opt'.$d] : '';
    $bgt_settings['pay_opt_val'.$d] = isset($bgt_settings['pay_opt_val'.$d]) ? $bgt_settings['pay_opt_val'.$d] : '';
?>
<tr>
    <th><label for="pay_opt<?php echo $d; ?>"><?php _e('Payment Option', 'begateway-payment'); ?> <?php echo $d; ?></label></th>
    <td><input type="text" id="pay_opt<?php echo $d; ?>" class="regular-text" name="bgt_settings[pay_opt<?php echo $d; ?>]" value="<?php echo $bgt_settings['pay_opt'.$d]; ?>" />
	<label for="pay_opt_val<?php echo $d; ?>"><strong><?php _e('Price', 'begateway-payment'); ?>:</strong></label>	<input type="text" id="pay_opt_val<?php echo $d; ?>" class="small-text" name="bgt_settings[pay_opt_val<?php echo $d; ?>]" value="<?php echo $bgt_settings['pay_opt_val'.$d]; ?>" />
    </td>
</tr>
<?php } ?>
<tr>
    <th><label for="other_amount"><?php _e('Show Other Amount', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="other_amount" name="bgt_settings[other_amount]" value="1" <?php checked( $other_amount ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want to show other amount text box to your visitors so they can enter custom amount.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="other_amount_title"><?php _e('Other Amount Title', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="other_amount_title" class="regular-text" name="bgt_settings[other_amount_title]" value="<?php echo $other_amount_title; ?>" />
    <p class="description"><?php _e('Enter a title for the Other Amount text box. The visitors will see this text.', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="card"><?php _e('Enable bankcard', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="card" name="bgt_settings[card]" value="1" <?php checked( $card ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want to accept bankcard payments.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="card"><?php _e('Enable halva', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="halva" name="bgt_settings[halva]" value="1" <?php checked( $halva ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want to accept halva payments.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="erip"><?php _e('Enable ERIP', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="erip" name="bgt_settings[erip]" value="1" <?php checked( $erip ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want to accept ERIP payments.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="erip_service_no"><?php _e('ERIP service code', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="erip_service_no" class="regular-text" name="bgt_settings[erip_service_no]" value="<?php echo $erip_service_no; ?>" />
    <p class="description"><?php _e('Enter your ERIP service code.', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="text_box"><?php _e('Show Reference Text Box', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="text_box" name="bgt_settings[text_box]" value="1" <?php checked( $text_box ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want your visitors to be able to enter a reference text like email, web address or name.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="text_box_title"><?php _e('Reference Text Box Title', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="text_box_title" class="regular-text" name="bgt_settings[text_box_title]" value="<?php echo $text_box_title; ?>" />
    <p class="description"><?php _e('Enter a title for the Reference text box (ie. Your Web Address). The visitors will see this text.', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="personal_details"><?php _e('Require Visitor Name', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="personal_details" name="bgt_settings[personal_details]" value="1" <?php checked( $personal_details ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want your visitors to be required to enter personal name during payment process.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="personal_email"><?php _e('Require Visitor Email', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="personal_email" name="bgt_settings[personal_email]" value="1" <?php checked( $personal_email ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want your visitors to be required to enter email during payment process.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="personal_address"><?php _e('Require Visitor Address Details', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="personal_address" name="bgt_settings[personal_address]" value="1" <?php checked( $personal_address ); ?> />
    <span class="description"><?php _e('Tick this checkbox if you want your visitors to be required to enter address details during payment process.', 'begateway-payment'); ?></span>
    </td>
</tr>
<tr>
    <th><label for="notification_url"><?php _e('Notification URL', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="notification_url" class="regular-text" name="bgt_settings[notification_url]" value="<?php echo $notification_url; ?>" placeholder="http://www.example.com/notification"/>
    <p class="description"><?php _e('Optional Notification URL where beGateway will post messages about processed payments', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="success_url"><?php _e('Success URL', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="success_url" class="regular-text" name="bgt_settings[success_url]" value="<?php echo $success_url; ?>" placeholder="http://www.example.com/success"/>
    <p class="description"><?php _e('Success URL where your customer will be redirected after a successful payment', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="decline_url"><?php _e('Decline URL', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="decline_url" class="regular-text" name="bgt_settings[decline_url]" value="<?php echo $decline_url; ?>" placeholder="http://www.example.com/decline"/>
    <p class="description"><?php _e('Decline URL where your customer will be redirected after a payment error', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="fail_url"><?php _e('Fail URL', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="fail_url" class="regular-text" name="bgt_settings[fail_url]" value="<?php echo $fail_url; ?>" placeholder="http://www.example.com/fail"/>
    <p class="description"><?php _e('Fail URL where your customer will be redirected after a failed payment', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="cancel_url"><?php _e('Cancel URL', 'begateway-payment'); ?></label></th>
    <td><input type="text" id="cancel_url" class="regular-text" name="bgt_settings[cancel_url]" value="<?php echo $cancel_url; ?>" placeholder="http://www.example.com/cancel"/>
    <p class="description"><?php _e('Cancel URL where your customer will be redirected when a payment process is cancelled by the customer', 'begateway-payment'); ?></p>
    </td>
</tr>
<tr>
    <th><label for="test_mode"><?php _e('Test mode', 'begateway-payment'); ?></label></th>
    <td><input type="checkbox" id="test_mode" name="bgt_settings[test_mode]" value="1" <?php checked( $test_mode ); ?> />
    <span class="description"><?php _e('Tick this checkbox to enable test mode', 'begateway-payment'); ?></span>
    </td>
</tr>
    </table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'begateway-payment') ?>" />
			</p>

		</form>
    </div></div></div>
<?php
}

// input params:
// product1:price|product2:price
// out params:
// [product1 => price, product2 => price]
function begateway_payment_parse_options($options) {
  $opt = explode('|', $options);
  $out = array();
  for($i=0; $i<sizeof($opt); $i++) {
    list($product,$price) = explode(':', $opt[$i]);
    if ($product && $price)
      $out[$product] = "$product|$price";
  }
  return $out;
}

function begateway_payment_parse_options_in_settings($options) {
  $out = array();
  for ($d = 1; $d <= 6; $d++) {
    $pay_opt = $options['pay_opt'.$d];
    $pay_opt_val = $options['pay_opt_val'.$d];
    if($pay_opt&&$pay_opt_val){
      $out[$pay_opt] = "$pay_opt|$pay_opt_val";
    }
  }
  return $out;
}

/*-----------------------------------------------------------------------------------*/
/*	Shortcode
/*-----------------------------------------------------------------------------------*/

function begateway_payment_callback( $atts, $content = null ) {
    $params = array(
      'type' => '',
      'class'  => '',
      'button_text'  => __('Pay', 'begateway-payment'),
      'button_class'  => 'bp_submit',
      'payment_subject' => '',
      'other_amount' => '',
      'other_amount_title' => '',
      'text_box' => '',
      'text_box_title' => '',
      'options' => '',
      'currency' => '',
      'shop_id' => '',
      'shop_key' => '',
      'checkout_base' => '',
      'card' => '',
      'halva' => '',
      'erip' => '',
      'erip_service_no' => '',
      'personal_email' => '',
      'personal_details' => '',
      'personal_address' => '',
      'notification_url' => '',
      'success_url' => '',
      'decline_url' => '',
      'fail_url' => '',
      'cancel_url' => '',
      'img' => '',
      'language' => ''
    );
    extract(shortcode_atts($params, $atts));

    $bgt_settings = get_option('bgt_settings');

    foreach($params as $p => $v) {
      if (empty($$p) && isset($bgt_settings[$p]))
        $$p = $bgt_settings[$p];
      $_SESSION[$p] = $$p;
    }

    $out = '<div class="bp_form ' . $class . '"><form id="begateway-payment-form">';

    if ($other_amount || $type=='1') {
        if($other_amount_title) {
            $out .= '<div class="bp_label">'.$other_amount_title.' ('.$currency.')</div>';
        }
        $out .= '<div class="bp_input"><input type="text" name="other_amount" required >';
        $out .= '</div>';
    } else {
        if($payment_subject) {
            $out .= '<div class="bp_label">'.$payment_subject.'</div>';
        }
        $out .= '<div class="bp_input"><select id="amount" name="amount" class="">';
        if (empty($options)) {
          $options = begateway_payment_parse_options_in_settings($bgt_settings);
        } else {
          $options = begateway_payment_parse_options($options);
        }

        foreach ($options as $product => $price) {
          if (!empty($product) && !empty($price))
            $out .= '<option value="'.$price.'">'.$product.'</option>';
        }
        $out .= '</select></div>';
    }

    if($text_box) {
        if($text_box_title) {
            $out .= '<div class="bp_label">'.$text_box_title.'</div>';
        }
        $out .= '<div class="bp_input"><input type="text" name="bp_text" required ></div>';
    }

    $out .= '<div class="bp_result"></div>';
    $out .= '<input type="submit" name="bp_submit" class="' . $button_class . '" value="' . esc_attr($button_text) . '" />';
    $out .= '<img class="bp_loader" src="'.plugins_url( '/img/loader.gif', __FILE__ ).'" alt="">';
    $out .= '</form></div>';

    return $out;
}
add_shortcode('begateway_payment', 'begateway_payment_callback');


function ajax_begateway_payment_callback() {

    check_ajax_referer( 'begateway-nonce', 'nonce' );

    $bgt_settings = get_option('bgt_settings');

    $amount = isset($_POST['amount']) ? $_POST['amount'] : '|';
    list($dsc, $amount) = explode("|", $amount);

    $other_amount = isset($_POST['other_amount']) ? $_POST['other_amount'] : '';

    $amount = str_replace(',', '.', $amount);
    $amount = strval(floatval($amount));

    $other_amount = str_replace(',', '.', $other_amount);
    $other_amount = strval(floatval($other_amount));

    $currency = $_SESSION['currency'];
    if (empty($currency))
      $currency = (empty($currency) && isset($bgt_settings['currency'])) ? $bgt_settings['currency'] : 'USD';

    if ($other_amount)
      $amount = $other_amount;

    $payment_subject = $_SESSION['payment_subject'];
    if (empty($payment_subject))
      $payment_subject = isset($bgt_settings['payment_subject']) ? $bgt_settings['payment_subject'] : NULL;

    $bp_text = isset($_POST['bp_text'] ) ? ' '.$_POST['bp_text'] : NULL;
    $dsc = empty($dsc) ? NULL : $dsc;

    if($payment_subject || $bp_text || $dsc) {
        $bp_text = array($payment_subject, $bp_text, $dsc);
        $bp_text = array_filter( $bp_text, 'strlen' );
        $bp_text = implode('. ', $bp_text);
    } else {
        $bp_text = __('No Description');
    }

    $lang = $_SESSION['language'];
    if (empty($lang))
      $lang = substr(get_bloginfo('language'), 0, 2);

    if(!$lang) {$lang = 'en';}

    $shop_id = $_SESSION['shop_id'];
    if (empty($shop_id))
      $shop_id = $bgt_settings['shop_id'];

    $shop_key = $_SESSION['shop_key'];
    if (empty($shop_key))
      $shop_key = $bgt_settings['shop_key'];

    $checkout_base = $_SESSION['checkout_base'];
    if (empty($checkout_base))
      $checkout_base = $bgt_settings['checkout_base'];

    $notification_url = $_SESSION['notification_url'];
    $cancel_url = $_SESSION['cancel_url'];
    $fail_url = $_SESSION['fail_url'];
    $decline_url = $_SESSION['decline_url'];
    $success_url = $_SESSION['success_url'];

    if (empty($notification_url))
      $notification_url = esc_url($bgt_settings['notification_url']);

    if (empty($cancel_url))
      $cancel_url = $bgt_settings['cancel_url'] ? esc_url($bgt_settings['cancel_url']) : get_site_url();
    if (empty($fail_url))
      $fail_url = $bgt_settings['fail_url'] ? esc_url($bgt_settings['fail_url']) : get_site_url();
    if (empty($decline_url))
      $decline_url = $bgt_settings['decline_url'] ? esc_url($bgt_settings['decline_url']) : get_site_url();
    if (empty($success_url))
      $success_url = $bgt_settings['success_url'] ? esc_url($bgt_settings['success_url']) : get_site_url();

    $card = $_SESSION['card'];
    $halva = $_SESSION['halva'];
    $erip = $_SESSION['erip'];
    $erip_service_no = $_SESSION['erip_service_no'];

    if (empty($card))
      $card = $bgt_settings['card'] ? $bgt_settings['card'] : '';
    if (empty($halva))
      $halva = $bgt_settings['halva'] ? $bgt_settings['halva'] : '';
    if (empty($erip))
      $erip = $bgt_settings['erip'] ? $bgt_settings['erip'] : '';

    if (empty($test_mode))
      $test_mode = $bgt_settings['test_mode'] ? $bgt_settings['test_mode'] : '';

    if (empty($erip_service_no))
      $erip_service_no = $bgt_settings['erip_service_no'] ? $bgt_settings['erip_service_no'] : '';

    if (!class_exists('BeGateway')) {
      require_once dirname(  __FILE__  ) . '/lib/beGateway/lib/BeGateway.php';
    }

    \beGateway\Settings::$shopId  = $shop_id;
    \beGateway\Settings::$shopKey = $shop_key;
    \beGateway\Settings::$checkoutBase = 'https://' . $checkout_base;

    $transaction = new \beGateway\GetPaymentToken;
    $transaction->money->setAmount($amount);
    $transaction->money->setCurrency($currency);
    $transaction->setDescription($bp_text);
    $transaction->setLanguage($lang);

    if ($notification_url)
      $transaction->setNotificationUrl($notification_url);

    $transaction->setSuccessUrl($success_url);
    $transaction->setDeclineUrl($decline_url);
    $transaction->setFailUrl($fail_url);
    $transaction->setCancelUrl($cancel_url);

    if (isset($bgt_settings['personal_details'])) {
      $transaction->setFirstNameVisible();
      $transaction->setLastNameVisible();
    }

    if (isset($bgt_settings['personal_email'])) {
      $transaction->setEmailVisible();
    }

    if (isset($bgt_settings['personal_address'])) {
      $transaction->setCityVisible();
      $transaction->setZipVisible();
      $transaction->setCountryVisible();
      $transaction->setStateVisible();
    }

    $transaction->setTestMode(!empty($test_mode));

    if (!empty($card)) {
      $cc = new \beGateway\PaymentMethod\CreditCard;
      $transaction->addPaymentMethod($cc);
    }

    if (!empty($halva)) {
      $hv = new \beGateway\PaymentMethod\CreditCardHalva;
      $transaction->addPaymentMethod($hv);
    }

    if (!empty($erip)) {
      $order_id = rand(10000, 500000);
      $erip = new \beGateway\PaymentMethod\Erip(array(
        'order_id' => $order_id,
        'account_number' => strval($order_id),
        'service_no' => $erip_service_no,
        'service_info' => array($bp_text)
      ));
      $transaction->addPaymentMethod($erip);
    }
    $response = $transaction->submit();

    if ($response->isSuccess() ) {
      echo json_encode(array(
        //'message' => $response->getMessage(),
        'status' => 'ok',
        //'token' => $response->getToken(),
        'gourl' => $response->getRedirectUrl()
      ));
   } else {
        echo json_encode(array(
                               'message' => '<div class="error">'. __('Error to acquire a payment token', 'begateway-payment').'</div>',
                               'status' => ''
                               ));
   }

    exit;
}

add_action( 'wp_ajax_bp_show', 'ajax_begateway_payment_callback' );
add_action( 'wp_ajax_nopriv_bp_show', 'ajax_begateway_payment_callback' );

/*-----------------------------------------------------------------------------------*/
/*	Widget
/*-----------------------------------------------------------------------------------*/
class widget_begateway_payment extends WP_Widget {

	function __construct() {
	/*Constructor*/
		$widget_ops = array('classname' => 'widget_begateway_payment ', 'description' => __( 'Widget beGateway Payment' , 'begateway-payment' ) );
		parent::__construct('begateway_payment', __( 'beGateway Payment' , 'begateway-payment' ), $widget_ops);
    }

	function widget($args, $instance) {
        /* prints the widget*/
		extract($args, EXTR_SKIP);

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title']);

        if($title) {
            echo $before_title . $title . $after_title;
        }

		echo do_shortcode('[begateway_payment]');


        echo $after_widget;
	}

	function update($new_instance, $old_instance) {

	/*save the widget*/
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance) {

		$instance = wp_parse_args( (array) $instance, array('title' => '') );
		$title = strip_tags($instance['title']);
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>:
			    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
<?php

	}
}

function register_begateway_payment_widget() {
    register_widget( 'widget_begateway_payment' );
}
add_action( 'widgets_init', 'register_begateway_payment_widget' );

function begateway_payment_register_session(){
    if(!session_id()) session_start();
}

function begateway_payment_init_var_json() {
  return json_encode(
    array(
      'url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('begateway-nonce')
    ), JSON_UNESCAPED_SLASHES
  );
}

add_action('init','begateway_payment_register_session');
wp_register_script('jquery3.2.1', 'https://code.jquery.com/jquery-3.2.1.min.js');
wp_add_inline_script('jquery3.2.1', 'var jQuery3_2_1 = $.noConflict(true);');
wp_enqueue_script( 'begateway-payment-plugin', plugins_url('js/begateway.js', __FILE__), array('jquery3.2.1'));
wp_enqueue_style('begateway-payment-plugin', plugins_url('css/begateway.css', __FILE__));
