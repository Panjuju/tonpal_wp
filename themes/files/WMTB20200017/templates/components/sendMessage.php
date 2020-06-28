<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header','vars',1);
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_desc = ifEmptyText($theme_vars['sendMessagePlaDesc']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);
$send_bg = ifEmptyText($theme_vars['sendimage']['value']);


?>
<style>
    input {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark-color(black, white);
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    -webkit-appearance: textfield;
    background-color: rgba(0,0,0,0);
    -webkit-rtl-ordering: logical;
    cursor: text;
    margin: 0em;
    font: 400 13.3333px Arial;
    padding: 1px 2px;
    border-width: 2px;
    border-style: inset;
    border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
    border-image: initial;

}
textarea {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark-color(black, white);
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
    -webkit-appearance: textarea;
    background-color: rgba(0,0,0,0);
    -webkit-rtl-ordering: logical;
    flex-direction: column;
    resize: auto;
    cursor: text;
    white-space: pre-wrap;
    overflow-wrap: break-word;
    margin: 0em;
    font: 400 13.3333px Arial;
    border-width: 1px;
    border-style: solid;
    border-color: -internal-light-dark-color(rgb(118, 118, 118), rgb(195, 195, 195));
    border-image: initial;
    padding: 2px;
}
    .inquiry-form input[type="text"].form-input,  .inquiry-form input[type="tel"].form-input, .inquiry-form input[type="message"].form-input, .inquiry-form input[type="email"].form-input,.inquiry-form textarea.form-text {
    position: relative;
    border-bottom: 1px solid #000 !important;
    border: none;
    width: 60%;
    height: 40px;
    line-height: 30px;
    margin: 0 0 10px;
    color: #000;
    padding: 0 0 0 6px;
}
@media only screen and (max-width:768px){
    .mt-15{
        position: absolute;
    left: 27px;
    padding-left: 0px ! important;
    width: 85%;
    }
    .inquiry-form input[type="text"].form-input, .inquiry-form input[type="tel"].form-input, .inquiry-form input[type="message"].form-input, .inquiry-form input[type="email"].form-input, .inquiry-form textarea.form-text{
        position: relative;
    border-bottom: 1px solid #000 !important;
    border: none;
    width: 100%;
    height: 40px;
    line-height: 30px;
    margin: 0 0 10px;
    color: #000;
    padding: 0 0 0 8px;
    }
    .background2{
        width: 200% ! important;
    height: 100%;
    float: right;
    }
}
</style>
<section class="inquiry-form-wrap ct-inquiry-form" id="myform">
<div style="background:url(<?php echo $send_bg ?>);background-size: cover;max-width:100%;height:110%">
<div class="background2" style="background:url(https://i.loli.net/2020/06/16/mnasqZAuY56UFDK.png);background-size: cover;width: 57%;height: 100%;float: right;">
<section class="mt-15" style="    padding-left: 200px;" id="myform">
    <h4 class="inquiry-form-title" style="padding-top: 20px;font-size: 22px;text-transform:uppercase; "><?php echo $message_title ?><div style="width:85px;    padding-top: 2px;border-bottom: 2px solid #df0000;text-align: center;"></div></h4>
    <form id="contact-form" class="contact_form" role="form">
        <section class="inquiry-form">
            <ul>
                <div class="form-left">
                    <ul>
                    <li class="form-item" style="max-width: 400px;padding-top: 6px;padding-bottom: 6px;">
                        <span class="tip"><?php echo $placeholder_desc ?></span>
                        
                    </li>
                    <li class="form-item" >

                        <input id="name" type="text" name="name" placeholder="<?php echo $placeholder_name ?>"class="form-input form-input-name">
                    </li>
                    <li class="form-item" >

                        <input id="phone" type="text" name="phone" placeholder="<?php echo $placeholder_phone ?>" class="form-input form-input-phone">
                    </li>
                    <li class="form-item" >
                       
                        <input id="email" type="text" name="email" placeholder="<?php echo $placeholder_email ?>" class="form-input form-input-email">
                    </li>
                    <ul>
                </div>
                <div class="form-right">
                    <li class="form-item"  >
       
                        <textarea id="message" type="message" name="message" style="height:90px;resize:none" placeholder="<?php echo $placeholder_content ?>" class="form-text form-input-massage"></textarea>
                    </li>
                </div>
            </ul>
            <div class="form-btn-wrapx" >
                
                <input type="hidden" name="organization_id" value="084ce65a-1973-11e9-bbf8-7cd30a51ed1a">
                <input type="hidden" name="product_title" value="<?php echo $type_title;?>">
                <div class="alert-success hidden" id="MessageSent" style="display: none">
                    We have received your message, we will contact you very soon.
                </div>
                <div class="alert-danger hidden" id="MessageNotSent" style="display: none">
                    Oops! Something went wrong please refresh the page and try again.
                </div>
                <input type="submit" id="customer_submit_button" value="<?php echo $message_btn;?>"
                class="wpcf7-form-control wpcf7-submit form-btn-submitx" style="margin-top: 10px;background-color: #df0000;border:#df0000;height:34px;color: white"/>
                
            </div>
        </section>
    </form>
</section>
</div>
</div>
</section>