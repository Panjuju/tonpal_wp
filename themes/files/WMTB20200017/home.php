<?php
global $wp; // Class_Reference/WP 类实例

// home.json -> widgets 数据获取
$theme_widgets = json_config_array('home', 'widgets');

// home.json -> vars 数据获取
$theme_vars = json_config_array('home', 'vars');
// widgets 数据处理

$home_carousel = $theme_widgets['carousel'];
$home_modular_one = $theme_widgets['modularOne'];


$home_about = $theme_widgets['about'];
$home_hot_product = $theme_widgets['hotProduct'];
$home_news = $theme_widgets['news'];

// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'], 'Home');
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
// 当前页面url
$page_url = get_full_path(1);
?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_Title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head') ?>
</head>
<style>
    .index_company_intr .hd_title:after {
        content: '';
        display: block;
        width: 32px;
        height: 4px;
        background-color: #df0000;
        margin: 3px auto 0;
    }
    .index_company_intr .company_img_list .item_img img {
    display: block;
    width: 100%;
    height: auto;
    max-height: 166px!important;
    min-height: 166px!important;
    max-width: 232px!important;
    min-width: 232px!important;
}
    .index_company_intr .company_intr_img img {
    display: block;
    min-height: 425px !important;
    max-height: 426px  ! important;
    width: 100%;
    height: auto;
}
    .product_items .product_item .item_img {
    border: 2px solid #ddd;
    min-height: 262px;
}
    @media only screen and (max-width: 480px){
    .product_items .product_item .item_img {
        outline: 0;
        border-width: 1px;
        min-height: auto ! important;
    }
    .product_items .product_item .item_title{
            width:145px ! important;
        }
    .product_item .item_img img{
        height: 143px;
    }
    .promote_list .promote_item img {
    display: block;
    width: 100%;
    height: auto;
    -webkit-transition: transform 1s ease;
    -o-transition: transform 1s ease;
    transition: transform 1s ease;
    max-height: 57px;
}
    }
    @media only screen and (max-width:768px) {
        .index_company_intr .company_intr_img img {
            display: none;

        }
        .product_items .product_item .item_title{
            width: 260px;
        }
        .promote_list .promote_item img {
    display: block;
    width: 100%;
    height: auto;
    -webkit-transition: transform 1s ease;
    -o-transition: transform 1s ease;
    transition: transform 1s ease;
    max-height: 125px;
}
        .index_company_intr .company_img_list .item_img img{
            display: block;
            width: 100%;
            height: auto;
            max-height: auto!important; 
            min-height: auto!important; 
            max-width: auto!important; 
            min-width: auto!important; 
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
</style>

<body>
    <div class="container">

        <!-- web_head start -->
        <?php get_header(); ?>
        <!--// web_head end -->

        <!-- carousel -->
        <?php get_template_part('templates/components/carousel'); ?>
        <!-- /carousel -->

        <!-- web_main start -->
        <section class="web_main index_main">
            <!-- banner -->
            <?php if ($home_carousel['display'] == 1) {
                $home_carousel_items = ifEmptyArray($home_carousel['vars']['items']['value']);
            ?>
                <section class="slider_banner">
                    <div class="swiper-wrapper">
                        <?php foreach ($home_carousel_items as $item) { ?>
                            <div class="swiper-slide">
                                <a href="<?php echo ifEmptyText($item['link'], 'javascript:;'); ?>">
                                    <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']); ?>" title="<?php echo ifEmptyText($item['title']); ?>" />
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slider_swiper_buttons index_swiper_control">
                        <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
                        <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
                    </div>
                    <div class="slider_swiper_control">
                        <div class="swiper-pagination swiper-pagination-white"></div>
                    </div>
                </section>
            <?php } ?>
            <!-- index_business -->

            <!-- index_product -->
            <?php if ($home_hot_product['display'] == 1) {
                $product_bigtitle = ifEmptyText($home_hot_product['vars']['bigtitle']['value']);
                $product_smalltitle = ifEmptyText($home_hot_product['vars']['smalltitle']['value']);
                $product_defaulttitle = ifEmptyText($home_hot_product['vars']['defaulttitle']['value']);
                $product_productlefttitle = ifEmptyText($home_hot_product['vars']['productlefttitle']['value']);
                $product_leftintroduce = ifEmptyText($home_hot_product['vars']['leftintroduce']['value']);
                $product_productrighttitle = ifEmptyText($home_hot_product['vars']['productlefttitle']['value']);
                $product_rightintroduce = ifEmptyText($home_hot_product['vars']['leftintroduce']['value']);
                $product_imageleft = ifEmptyText($home_hot_product['vars']['imageleft']['value']);
                $product_imageright = ifEmptyText($home_hot_product['vars']['imageright']['value']);
                $product_items = ifEmptyArray($home_hot_product['vars']['items']['value']);

            ?>
                <section class="index_product">
                    <div class="layout">
                        <div class="index_bd">
                            <div class="hot_pd_items">
                                <div class="col_left wow fadeInLeftA">
                                    <header class="product_hd">
                                        <h2 class="hd_tit_big"><?php echo $product_bigtitle; ?></h2>
                                        <h5 class="hd_tit_small"><?php echo $product_smalltitle; ?></h5>
                                        <h3 class="hd_tit_default"><?php echo $product_defaulttitle; ?></h3>
                                    </header>
                                    <div class="hot_pd_item">
                                        <figure>
                                            <?php if (!empty($product_imageleft)) { ?>
                                                <span class="item_img" ><a href="product.html"><img src="<?php echo $product_imageleft; ?>" alt="" /></a></span>
                                            <?php } ?>
                                            <figcaption class="item_info">
                                                <?php if (!empty($product_productlefttitle)) { ?>
                                                    <h3 class="item_title "><a href="product.html"><?php echo $product_productlefttitle; ?></a></h3>
                                                <?php } ?>
                                                <div class="item_desc" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 5; -webkit-box-orient: vertical;">
                                                    <?php if (!empty($product_leftintroduce)) { ?>
                                                        <p><?php echo $product_leftintroduce; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col_right wow fadeInRightA">
                                    <div class="hot_pd_item">
                                        <figure>
                                            <?php if (!empty($product_imageright)) { ?>
                                                <span class="item_img" ><a href="product.html"><img src="<?php echo $product_imageright; ?>" alt="" /></a></span>
                                            <?php } ?>
                                            <figcaption class="item_info">
                                                <?php if (!empty($product_productrighttitle)) { ?>
                                                    <h3 class="item_title "><a href="product.html"><?php echo $product_productrighttitle; ?></a></h3>
                                                <?php } ?>
                                                <div class="item_desc" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 5; -webkit-box-orient: vertical;">
                                                    <?php if (!empty($product_rightintroduce)) { ?>
                                                        <p><?php echo $product_rightintroduce; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="product_slider">
                                <div class="swiper-container">
                                    <ul class="product_items">
                                        <?php foreach ($product_items as $item) { ?>
                                            <li class="product_item wow fadeInLeftA" style="min-height: 262px;"data-wow-delay=".1s">
                                                <figure>
                                                    <span class="item_img" style="max-width: 258px;">
                                                        <img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['alt']) ?>" />
                                                        <a href="<?php echo ifEmptyText($item['link'], 'javascript:;'); ?>"></a>
                                                    </span>
                                                    <figcaption>
                                                        <h3 class="item_title" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><a href="<?php echo ifEmptyText($item['link'], 'javascript:;'); ?>"><?php echo ifEmptyText($item['title']); ?></a></h3>
                                                    </figcaption>
                                                </figure>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!-- index_company_intr -->
            <?php if ($home_about['display'] == 1) {
                $home_about_title = ifEmptyText($home_about['vars']['title']['value']);
                $home_about_subtitle = ifEmptyText($home_about['vars']['subtitle']['value']);
                
                
                $home_about_desc = ifEmptyText($home_about['vars']['desc']['value']);
              
                $home_about_items = ifEmptyArray($home_about['vars']['items']['value']);
                $home_about_subitems = ifEmptyArray($home_about['vars']['subitems']['value']);
            ?>
                <section class="index_company_intr">
                    <header class="index_bd" style="margin-bottom: 40px;border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding-top: 15px;padding-bottom: 15px;text-align: center;">
                        <h2 class="hd_title"><?php echo $home_about_title; ?></h2>
                    </header>
                    <div class="layout">
                        <div class="index_bd wow fadeInUpA">
                            <div class="company_intr_img">
                                <div class="company_intr_img_slide">
                                    <ul class="swiper-wrapper">
                                        <?php foreach ($home_about_items as $item) { ?>
                                            <li class="swiper-slide"><a href="<?php echo ifEmptyText($item['link'], 'javascript:;'); ?>"><img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['alt']); ?>"></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="company_intr_cont">
                                <h2 class="company_intr_title" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical;"><?php echo $home_about_subtitle; ?></h2>
                                <p class="company_intr_desc" style="min-height:170px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 6 !important; -webkit-box-orient: vertical;"><?php echo $home_about_desc; ?></p>
                                <div class="company_img_list">
                                    <ul>
                                        <?php foreach ($home_about_subitems as $subitem) { ?>
                                            <li><a href=""><span class="item_img"><img src="<?php echo ifEmptyText($subitem['image']); ?>" alt=""><i class="item_more">more</i></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!-- promote -->
            <?php if ($home_modular_one['display'] == 1) {
               
                $modular_one_title = ifEmptyText($home_modular_one['vars']['title']['value']);
                
                $modular_one_link = ifEmptyText($home_modular_one['vars']['link']['value'], 'javascript:;');
                $modular_one_items = ifEmptyText($home_modular_one['vars']['items']['value']);
                $modular_one_subitems = ifEmptyText($home_modular_one['vars']['subitems']['value']);
            ?>
                <section class="index_promote">
                    <header class="index_hd" style="margin-bottom: 40px;border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding-top: 15px;padding-bottom: 15px;text-align: center;">
                        <h2 class="hd_title"><?php echo $modular_one_title; ?></h2>
                    </header>
                    <div class="layout">
                        <div class="index_bd wow fadeInUpA">
                            <div class="promote_slider">
                                <ul class="swiper-wrapper">
                                    <?php foreach ($modular_one_subitems as $subitem) { ?>
                                        <li class="promote_bn swiper-slide" style="max-height: 378px;"><a href="<?php echo ifEmptyText($subitem['link']); ?>"><img style="width:1400px;" src="<?php echo ifEmptyText($subitem['image']); ?>" alt=""></a></li>
                                    <?php } ?>
                                </ul>
                                <div class="index_swiper_control">
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                            <div class="promote_list">
                                <ul>
                                    <?php foreach ($modular_one_items as $item) { ?>
                                        <li class="promote_item"><a href="<?php echo ifEmptyText($item['link']); ?>"><img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['alt']); ?>"></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!--// web_main end -->
            <!--  footer start -->
            <?php get_template_part('templates/components/footer'); ?>
            <!--  footer end -->


    </div>
    <?php get_footer(); ?>

</body>

</html>