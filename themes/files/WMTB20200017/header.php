<?php
global $wp; // Class_Reference/WP 类实例
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}
set_query_var('languagesArray', $languagesArray);

// header.json -> vars 数据获取
$theme_vars = json_config_array('header', 'vars', 1);
$header_logo = ifEmptyText($theme_vars['logo']['value']);


$header_key_word = ifEmptyText($theme_vars['keyWord']['value']);
$header_search_Tip = ifEmptyText($theme_vars)['searchTip']['value'];
$header_search_Slogan = ifEmptyText($theme_vars)['searchSlogan']['value'];


$home_url = get_lang_home_url();

$languagesArray = get_query_var('languagesArray');

?>

<style>
    .change-language .change-language-title a:after{
        font-family: 'fontawesome';
    content: "\f0d7" ! important;
    font-size: 12px;
    display: inline-block;
    padding-left: 2px;
    }
    .nav_wrap .head_nav li ul a{
        color: #fff;
    white-space: nowrap;
    }
</style>

<header class="index_web_head web_head <?php if (is_home()) echo 'index_web_head'; ?>">
    <div class="head_top">
        <div class="layout">
            <div class="head_right">
            <b id="btn-search" class="btn--search"></b>
                <!-- 语种 -->
                <?php if ($languagesArray !== []) { ?>
                    <div class="change-language ensemble">
                        <div class="change-language-title medium-title">
                            <div class="language-flag language-flag-en"><a title="English" href="javascript:;"> <b class="country-flag"></b> <span>English</span> </a> </div>
                        </div>

                        <div class="change-language-cont sub-content"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="head_layer">
        <div class="layout">
            <?php if (is_home()) { ?>
                <figure class="logo">
                    <a href="<?php echo $home_url; ?>">
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        <span><?php echo $header_title;
                                echo $header_key_word; ?></span>
                    </a>
                </figure>
            <?php } else { ?>
                <figure class="logo">
                    <a href="<?php echo $home_url; ?>">
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        <span><?php echo $header_title;
                                echo $header_key_word; ?></span>
                    </a>
                </figure>
            <?php } ?>
            
            <nav class="nav_wrap">
                <?php if (has_nav_menu('primary')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_class' => 'head_nav',
                            'container' => 'ul',
                            'container_class' => 'nav-current'
                        )
                    );
                } ?>
            </nav>

        </div>
    </div>
    </div>
    
</header>
<div class="web-search"> <b id="btn-search-close" class="btn--search-close"></b>
    <div style=" width:100%">
        <div class="head-search">
            <form class="" action="">
                <input class="search-ipt" name="s" placeholder="<?php echo $header_search_Tip; ?>" style="text-transform:none;"/>
                <input class="search-btn" type="button" />
                <span class="search-attr"><?php echo $header_search_Slogan; ?></span>
            </form>
        </div>
    </div>
</div>
<?php if ($languages !== [] && $languagesArray !== []) { ?>
    <ul class="prisna-wp-translate-seo" id="prisna-translator-seo">
        <?php foreach ($languagesArray as $item) { ?>
            <li class="language-flag language-flag-en">
                <a title="<?php echo $item['abbr'] ?>" href="<?php echo $item['link'] ?>">
                    <b class="country-flag"></b>
                    <span><?php echo $item['abbr'] ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<!--// header end  -->