<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer', 'vars', 1);
$theme_widgets = json_config_array('footer', 'widgets', 1);


$footer_information = $theme_widgets['information'];
$mobile = ifEmptyArray($theme_widgets['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);


$header_vars = json_config_array('header', 'vars', 1);

$facebook_link = ifEmptyText($header_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($header_vars['twitterLink']['value']);
$youtube_link = ifEmptyText($header_vars['youtubeLink']['value']);



$footer_about_abstract = ifEmptyText($theme_vars['aboutAbstract']['value']);
$footer_contact_title = ifEmptyText($theme_vars['contactTitle']['value']);

$footer_contact_mobile = ifEmptyText($mobile['value']);
$footer_contact_email = ifEmptyText($email['value']);
$footer_contact_address = ifEmptyText($address['value']);


$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);

$footer_quick_link = ifEmptyText($theme_vars['quickLink']['value']);
$footer_about_image = ifEmptyText($theme_vars['aboutimage']['value']);





$languagesArray = ifEmptyArray(get_query_var('languagesArray'));




$googleExtantion = get_option('google_extantion');
$gooleId = get_option('goole_id');
set_query_var('gooleId', $gooleId);

?>
<style>
  .copyright,
  .copyright a {
    color: #535353;
  }

  @media only screen and (max-width: 950px) {
    .footer_nav>li {
      border-bottom: none;
      line-height: 35px;
    }
  }

  .web_footer,
  .web_footer a {
    color: white;
  }

  .web_footer {
    padding: 35px 0;
    line-height: 1.5;
    background-color: #4B4B4B;
    font-size: 16px;
  }

  .foot_items:after {
    display: none;
  }

  .foot_item_info {
    -webkit-box-flex: 0 0 33.33333333%;
    -webkit-flex: 0 0 33.33333333%;
    -ms-flex: 0 0 33.33333333%;
    flex: 0 0 33.33333333%;
    max-width: 33.33333333%;
    width: 33.33333333%;
  }

  .foot_item {
    display: inline-block;
    -webkit-box-flex: 0 0 25%;
    -webkit-flex: 0 0 25%;
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
    width: 25%;
    float: left;
    padding: 15px;
  }

  .foot_items {
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-direction: row;
    flex-direction: row;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-flex-wrap: wrap;
    -moz-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    -o-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: 0 -15px;
  }

  .foot_item .title {
    font-size: 18px;
    line-height: 25px;
    padding-top: 15px;
    text-transform: uppercase;
    margin-bottom: 25px;
    letter-spacing: 1px;
  }

  .foot_contact_list .contact_item {
    line-height: 25px;
    padding-bottom: 5px;
    margin-bottom: 1em;
    font-style: normal;
  }

  .meiyou .nav_wrap .footer_nav {
    font-size: 14px;
  }

  .meiyou .nav_wrap .footer_nav li ul {
    display: none;
  }

  .meiyou .nav_wrap .footer_nav {
    margin-top: 22px;
  }

  .meiyou .nav_wrap .footer_nav>li>a:before {
    content: '';
    display: inline-block;
    width: 7px;
    height: 7px;
    background-color: white;
    position: absolute;
    left: 0px;
    top: 35%;
    margin-top: -1px;
    border-radius: 50%;
  }

  .meiyou .nav_wrap .footer_nav>li>a {
    position: relative;
    display: inline-block;
    padding: 0 6px;
    border-radius: 5px;
    display: block;
    padding-left: 22px;
  }

  .meiyou .nav_wrap .footer_nav>li {
    display: block;
    height: 1.5em;
    line-height: 1.5em;
    overflow: hidden;
    margin-bottom: .5em;
  }

  .meiyou .nav_wrap .footer_nav>li>a>b:after {
    display: none;
  }

  .foot_contact_list .contact_ico {
    display: inline-block;
    width: 21px;
    height: 21px;
    background-repeat: no-repeat;
    background-position: 0 0;
    background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/contact_ico.png);
    float: left;
    margin-top: 2px;
  }

  .foot_contact_list .contact_ico_local {
    background-position: 0 -84px;
  }

  .foot_contact_list .contact_ico_email {
    background-position: 0 -42px;
  }

  .foot_contact_list .contact_ico_phone {
    background-position: 0 0;
  }

  @media only screen and (max-width:768px) {
    .index_company_intr .company_intr_img img {
      display: none;

    }

    .footcen {
      text-align: center ! important;
      float: none ! important;
    }

    .copyright {
      display: inherit ! important;
    }
    
    .foot_item {
      -webkit-box-flex: 0 0 100% ! important;
      -webkit-flex: 0 0 100% ! important;
      -ms-flex: 0 0 100% ! important;
      flex: 0 0 100% ! important;
      max-width: 100% ! important;
      width: 100% ! important;
    }
  }
  .nav_wrap .footer_nav>li:hover>a {
    color: #fff500;
}
</style>
<!--  footer start -->
<footer class="web_footer">
  <section class="foot_service">
    <div class="layout">
      <div class="foot_items">
        <nav class="foot_item foot_item_info wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
          <div class="foot_logo"><img style="margin-bottom: 30px;" src="<?php echo $footer_about_image ?>" alt=""></div>
          <div class="info_desc" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 6 !important; -webkit-box-orient: vertical;"><?php echo $footer_about_abstract ?></div>
        </nav>
        <nav class="foot_item foot_item_product wow fadeInLeftA" data-wow-delay=".2s" data-wow-duration=".8s">
          <div class="foot_item_hd">
            <h2 class="title"><?php echo $footer_quick_link ?></h2>
          </div>
          <div class="foot_item_bd">
            <div class="meiyou">
              <nav class="nav_wrap">
                <?php if (has_nav_menu('primary')) {
                  wp_nav_menu(
                    array(
                      'theme_location' => 'primary',
                      'menu_class' => 'footer_nav',
                      'container' => 'ul',
                      'container_class' => 'nav-current'
                    )
                  );
                } ?>
              </nav>
            </div>
          </div>
        </nav>
        <nav class="foot_item wow fadeInLeftA" data-wow-delay=".3s" data-wow-duration=".8s">
          <div class="foot_item_hd">
            <h2 class="title"><?php echo $footer_contact_title ?></h2>
          </div>
          <div class="foot_item_bd" style="margin-top: 45px;">
            <address class="foot_contact_list">
              <!--
                    icons:
                     ============================
                     contact_ico_local
                     contact_ico_phone
                     contact_ico_email
                     contact_ico_fax
                     contact_ico_skype
                     contact_ico_time  -->
              <ul>

                <li class="contact_item">
                  <i class="contact_ico contact_ico_phone"></i>
                  <div class="contact_txt">
                    <a class="tel_link" href="tel:"><span class="item_label">Phone:</span><span class="item_val"><?php echo $footer_contact_mobile ?></span></a>
                  </div>
                </li>
                <li class="contact_item">
                  <i class="contact_ico contact_ico_email"></i>
                  <div class="contact_txt">
                    <a href="mailto:"><span class="item_label">Email:</span><span class="item_val"><?php echo $footer_contact_email ?></span></a>
                  </div>
                </li>
                <li class="contact_item">
                  <i class="contact_ico contact_ico_local"></i>
                  <div class="contact_txt">
                    <span class="item_val"><?php echo $footer_contact_address ?></span>
                  </div>
                </li>
              </ul>
            </address>

          </div>
        </nav>
      </div>
    </div>
  </section>

</footer>
<section class="footer">
  <section class="layout">
    <div class="footcen" style="float:right;">
      <?php if ($footer_information['display'] == 1) {
        $footer_information_items = ifEmptyText($footer_information['vars']['items']['value']);
      ?>
        <ul class="foot_sns" style="display: inline-flex;margin-top: 10px;">
          <?php foreach ($footer_information_items as $item) { ?>
            <li style="width: 20px;margin-right:10px;"><a href="<?php echo ifEmptyText($item['link']); ?>"><img src="<?php echo ifEmptyText($item['image']); ?>" alt=""></a></li>
          <?php } ?>
        </ul>
      <?php } ?>  
    </div>
    <?php if (ifEmptyText($footer_copyright) !== '') : ?>
      <div class="copyright" style="display: inline-flex;">Copyright&nbsp;©&nbsp;<span class="get-cur-year"><?php echo date('Y') ?>&nbsp;</span><?php echo $footer_copyright ?>
      |<a href="/privacy_policy.html">&nbsp;Privacy Policy&nbsp;</a> |<a href="/sitemap.xml">&nbsp;Sitemap&nbsp;</a>
        |<a href="info-news">&nbsp; info News &nbsp;</a>|<a href="info-product">&nbsp; info Products &nbsp;</a>
      </div>
    <?php endif; ?>

  </section>
</section>


<!-- /footer -->