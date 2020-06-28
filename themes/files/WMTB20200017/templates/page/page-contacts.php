<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts', 'vars');

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
$page_bg = ifEmptyText($theme_vars['image']['value']);

$theme_widgets_footer = json_config_array('footer', 'widgets', 1);
$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value']);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value']);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value']);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$theme_vars_header = json_config_array('header', 'vars', 1);
$type_title = $contacts_title;

$message_btn = ifEmptyText($theme_vars_header['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars_header['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars_header['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars_header['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars_header['sendMessagePlaContent']['value']);
?>

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>

</head>
<style>
    .ct-inquiry-form {
  overflow: hidden;
  height: 460px;
  background-color: #f2f2f2;
  margin: 20px 0 !important;
  /* 背景图 */
  /* 发送表单 */
}
.ct-inquiry-form .send-bg {
  float: left;
  width: 400px;
  height: 100%;
}
.ct-inquiry-form .send-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.ct-inquiry-form .send-content {
  float: left;
  padding: 25px;

}
.ct-inquiry-form .send-content .inquiry-form-title {
  font-size: 23px;
  color: #2d2d2d;
}

.ct-inquiry-form .inquiry-form > ul {
  position: relative;
  height: 196px;
}
.ct-inquiry-form .inquiry-form .form-item {
  width: 770px;
  height: 30px;
  margin-bottom: 18px;
  border: 1px solid #5b5b5b;
}
.ct-inquiry-form .inquiry-form .form-item input,
.ct-inquiry-form .inquiry-form .form-item textarea {
  width: 100%;
  height: 100%;
  border: none;
  text-indent: 10px;
}
.ct-inquiry-form .inquiry-form .form-item textarea {
  resize: none;
}
.ct-inquiry-form .inquiry-form .form-item-message {
  height: 60%;
  
  top: 0;
  right: 0;
}
.ct-inquiry-form .inquiry-form .form-btn-wrapx {
  padding-top: 100px;
}
.ct-inquiry-form .inquiry-form .form-btn-wrapx #customer_submit_button {
  width: 20%;
  height: 40px;
  line-height: 40px;
  text-align: center;
  color: #fff;
  font-weight: bold;
  border: none;
  background-color: #df0000;
}
.page-contacts .blog-article::after {
  content: '';
  display: block;
  clear: both;
}
.page-contacts .blog-article .ct-inquiry-form {
  display: inline-block;
  width: auto;
  margin: 0 !important;
  height: 515px;
}
.page-contacts .blog-article .ct-inquiry-form .send-bg {
  display: none;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title {
  position: relative;
  padding-bottom: 25px;
  margin-bottom: 30px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title::after {
  position: absolute;
  bottom: 0;
  left: 0;
  content: '';
  display: block;
  width: 60px;
  height: 2px;
  background-color: #ffaa00;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title + p {
  display: none;
}
.page-contacts .blog-article .ct-inquiry-form .send-content {
  display: inline-block;
  padding: 20px 30px;
  padding-bottom: 0;
  width: 820px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form > ul {
  height: auto;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form li {
  position: static;
  width: 100%;
  height: 35px;
  margin-bottom: 20px;
  border-color: #8e8e8e;
  border-radius: 2px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form .form-item-message {
  height: 144px;
}
.page-contacts .blog-article .ct-inquiry-form .form-btn-wrapx {
  padding-top: 20px;
}
.page-contacts .blog-article .ct-inquiry-form .form-btn-wrapx #customer_submit_button {
  width: auto;
  padding: 0 20px;
  height: 35px;
  line-height: 35px;
  border-radius: 2px;
}
.page-contacts .left-form {
  float: left;
}
.page-contacts .right {
  float: left;
  padding-left: 40px;
  width: 330px;
}
.page-contacts .right p {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 5;
  line-height: 1.5;
  font-size: 15px;
  color: #2d2d2d;
}
.page-contacts .right li {
  position: relative;
  margin-top: 30px;
  font-size: 16px;
  color: #2d2d2d;
}
.page-contacts .right li img {
  position: absolute;
  top: 2px;
  left: 0;
  width: 27px;
  height: 20px;
  object-fit: contain;
}
.page-contacts .right li span {
  display: block;
  box-sizing: border-box;
  padding-left: 35px;
}
.page-contacts .main_content {
  padding-bottom: 20px;
}
@media only screen and (max-width:768px){
  .right{
    display: none;
  }
  .page-contacts .blog-article .ct-inquiry-form{
    display: inline-block;
    width: 155%;
    margin: 0 !important;
    height: 515px;
  }
  .page-contacts .blog-article .ct-inquiry-form .send-content {
  display: inline-block;
  padding: 20px 30px;
  padding-bottom: 0;
  width:100%;
}
}
</style>
<body>
    <div class="container">

        <!-- web_head start -->
        <?php get_template_part('header-list'); ?>
        <!--// web_head end -->


        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- page-layout start -->
        <section class="main_content page-contacts">
            <div class="layout">
                <!-- main start -->
               
                    <article class="blog-article" style="display: flex;    margin-top: 30px;">
                        <div class="left-form" style="width: 64.5%;">
                            <?php get_template_part('templates/components/sendMessage-contanct') ?>
                        </div>

                        <div class="right" style="padding: 0 0 0 150px;width: 36%;">
                        <div style="height: 250px;">
                        <?php if (!empty($contacts_desc)) { ?>
            <p class="text-center contact-margin"><?php echo $contacts_desc ?></p>
                        <?php } ?>
                        </div>
                        <ul class="contacts-ul" style="margin-top: 10px;">
                            <?php if (!empty($email))
                             { ?>
                                <li class="email" style="margin-top: 10px;">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-1.png" alt="">
                                    <?php foreach ($email as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } 
                                    ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($phone)) {  ?>
                                <li class="phone" style="margin-top: 20px;">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/ 1-3.png" alt="">
                                    <?php foreach ($phone as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($mobile)) {  ?>
                                <li class="mobile" style="margin-top: 20px;">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-2.png" alt="">
                                    <?php foreach ($mobile as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                            <?php if (!empty($address)) {  ?>
                                <li class="address" style="margin-top: 20px;">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icon/1-4.png" alt="">
                                    <?php foreach ($address as $item) { ?>
                                        <span><?php echo $item['value'] ?></span>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    </article>
                
                <!--// main end -->
            </div>
        </section>
        <!--// page-layout end -->
        <div class="contacts_footer" style="margin-top: 30px;">
            <div class="layout">
                <?php get_template_part('templates/components/tags-random-product') ?>
            </div>
        </div>
        <!-- web_footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--// web_footer end -->
    </div>

</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>