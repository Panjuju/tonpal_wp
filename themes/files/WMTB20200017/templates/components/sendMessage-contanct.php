<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$data = get_post();
$type_title = $data->post_name;

$message_bg = ifEmptyText($theme_vars['sendMessageBg']['value']);
$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);


$contacts_desc = ifEmptyText(get_query_var('contactsDesc'));
$contacts_desc = 'We have received your message, we will contact you very soon. We have received your message, we will contact you very soon.';
?>
<style>
    .send-content .hd_title{display: inline-block;text-transform: uppercase;font-weight: normal;}
			.send-content .hd_title:after {
				content: '';
				display: block;
				width: 60px;
				height: 4px;
				background-color: #df0000;
				margin: 3px 0;
			}
</style>
<section class="inquiry-form-wrap ct-inquiry-form mt50" id="myform">
    
    <div class="send-content">
    <h2 class="hd_title"  style="text-transform:uppercase; margin-bottom:26px;"><?php echo $message_title ?></h2>
    <form id="contact-form" class="contact_form" role="form">
      
            <section class="inquiry-form">
                <ul>
                    <li class="form-item">
                        <input id="name" type="text" name="name" class="form-input form-input-name" placeholder="<?php echo $placeholder_name ?>">
                    </li>
                    <li class="form-item">
                        <input id="email" type="text" name="email" class="form-input form-input-email" placeholder="<?php echo $placeholder_email ?>">
                    </li>
                    <li class="form-item">
                        <input id="phone" type="text" name="phone" class="form-input form-input-phone" placeholder="<?php echo $placeholder_phone ?>">
                    </li>
                    <li class="form-item form-item-message">
                        <textarea id="message" type="message" name="message" class="form-text form-input-massage" placeholder="<?php echo $placeholder_content ?>"></textarea>
                    </li>
                </ul>

                <div class="form-btn-wrapx">
                    <input type="hidden" name="organization_id" value="084ce65a-1973-11e9-bbf8-7cd30a51ed1a">
                    <input type="hidden" name="product_title" value="<?php echo $type_title; ?>">
                    <div class="alert-success hidden" id="MessageSent" style="display: none">
                    We have received your message, we will contact you very soon.
                </div>
                <div class="alert-danger hidden" id="MessageNotSent" style="display: none">
                    Oops! Something went wrong please refresh the page and try again.
                </div>
                    <input type="submit" id="customer_submit_button" value="<?php echo $message_btn; ?>" class="wpcf7-form-control wpcf7-submit form-btn-submitx" />
                </div>
            </section>
    </form>
    </div>
</section>