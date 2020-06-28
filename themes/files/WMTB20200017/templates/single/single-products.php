<?php
global $wp; // Class_Reference/WP 类实例
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'), 'Tag');

$post = get_post();
$theme_vars = json_config_array('products', 'vars');
$product_detail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$product_detail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);

// 获取父级的背景图
$page_bg = ifEmptyText(get_term_meta(ROOT_CATEGORY_CID, 'background', true));
// 主图处理
$photos = ifEmptyArray(get_post_meta(get_post()->ID, 'photos'));
$photosArray = [];
foreach ($photos as $key => $item) {
    array_push($photosArray, json_decode($photos[$key], true));
}

// pdf
$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));

// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));

// 当前页面url
$page_url = get_lang_page_url();

$sub_title = ifEmptyText(get_post_meta(get_post()->ID, 'sub_title', true));

// 详情筛选
$detailArray = [];
$contentArray = json_decode($post->post_content, true);
foreach ($contentArray as $key => $item) {
    if ($item['content'] !== '') {
        $detailArray[$key]['tabName'] = $item['tabName'];
        $detailArray[$key]['content'] = $item['content'];
    }
}

?>
<!-- <style>
    @media only screen and (max-width:768px){
.product-intro .image-additional {
    
    display: none;
}
.product-view .product-image, .single_product_items {
    display: block ! important;
}
.product-intro .swiper-button-next{
    display: none;
}
.product-intro .swiper-button-prev{
    display: none;
}
}
</style> -->

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- OG -->
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:description" content="<?php echo $seo_description; ?>" />
    <meta property="og:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <meta property="og:site_name" content="<?php get_host_name(); ?>" />
    <!-- itemprop -->
    <meta itemprop="name" content="<?php echo $post->post_title; ?>" />
    <meta itemprop="description" content="<?php the_excerpt(); ?>" />
    <meta property="image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <!-- Twitter -->
    <meta name="twitter:site" content="@affiliate_<?php get_host_name();; ?>" />
    <meta name="twitter:creator" content="@affiliate_<?php get_host_name(); ?>" />
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:description" content="<?php echo $seo_description; ?>" />
    <meta name="twitter:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />

    <?php get_template_part('templates/components/head') ?>
</head>
<style>
    .prev>a{
        text-decoration: underline;
    }
    .next>a{
        text-decoration: underline;
    }
    .next{
        border-bottom: 1px solid #808080;
        padding-bottom: 10px;
    }
</style>
<body>
<div class="container">
    <!-- header start -->
    <?php get_template_part('header-list'); ?>
    <!--// header end  -->
    
    <?php get_breadcrumbs();?>
    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <div class="product-intro">
                <div class="product-view">
                    <div class="product-image">
                        <a class="cloud-zoom" id="zoom1" data-zoom="adjustX:0, adjustY:0" href="<?php echo ifEmptyText($photosArray[0]['url']); ?>" title="">
                            <img src="<?php echo ifEmptyText($photosArray[0]['url']); ?>" itemprop="image" title="" alt="" style="width:100%" />
                        </a>
                    </div>
                    <div style="position:relative; ">
                        <div class="image-additional">
                            <ul class="swiper-wrapper">
                                <?php foreach ($photosArray as $key => $item) { ?>
                                    <li style="border: 1px #ddd solid;width:25%;margin-top:10px;" class="swiper-slide image-item <?php if ($key == 0) echo 'current'; ?>">
                                        <a class="cloud-zoom-gallery item" href="<?php echo ifEmptyText($item['url']) ?>" data-zoom="useZoom:zoom1, smallImage:<?php echo ifEmptyText($item['url']) ?>" title="">
                                            <img src="<?php echo ifEmptyText($item['url']) ?>_thumb_262x262.jpg" title="" alt="" />
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="swiper-pagination swiper-pagination-white"></div>
                        </div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                </div>
                <div class="product-summary">
                    <?php if ($sub_title == '') { ?>
                        <h1 class="page_title"><?php echo $post->post_title ?></h1>
                    <?php } else {  ?>
                        <div class="page_title">
                            <?php echo $post->post_title ?>
                        </div>
                    <?php }  ?>
                    <?php if ($sub_title != '') { ?>
                        <h1 class="sub-title">
                            <?php echo $sub_title ?>
                        </h1>
                    <?php }  ?>
                    
                    <div class="share-this">
                                <!--share-->
                                <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                                <div class="sharethis-inline-share-buttons" style="text-align: left;"></div>
                                <!--// share-->
                            </div>
                    <div class="product-meta">
                        <p style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 14; -webkit-box-orient: vertical;"><?php echo $post->post_excerpt ?></p>
                    </div>
                    
                    
                </div>
                <div class="gm-sep product-btn-wrap" style="text-align: right;">

                        <a href="#myform" class="email"><?php echo $product_detail_inquiry_btn ?></a>
                        <?php if ($pdf !== '') { ?>
                            <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $product_detail_download_btn ?></a>
                        <?php } ?>
                        <a href="#myform" class="pdf"><?php echo $product_detail_download_btn ?></a>
                                <?php if ($pdf !== '') { ?>
                                    <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?></a>
                                <?php } ?>
                    </div>
            </div>
            <div class="tab-content-wrap product-detail">
                <div class="gm-sep tab-title-bar detail-tabs">
                    <?php foreach ($detailArray as $key => $item) { ?>
                        <h2 class="tab-title  title <?php if ($key == 0) echo 'current'; ?> "><span><?php echo $item['tabName']; ?></span></h2>
                    <?php } ?>
                </div>
                <div class="tab-panel-wrap">
                    <?php foreach ($detailArray as $key => $item) { ?>
                        <div class="tab-panel disabled">
                            <div class="tab-panel-content">
                                <?php echo $item['content']; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="chapter underline border-bottom-2">
                <?php
                // prev
                get_prev_or_next_post('prev', 'prev', 'Prev: ', '');
                // next
                get_prev_or_next_post('next', 'next', 'Next: ', '');
                ?>
            </div>
           
        </div>

            
        <div class="layout"><h2 style="margin-bottom: 10px;margin-top: 10px;">TAGS</h2>
                        <?php get_template_part('templates/components/tags-random-product') ?>
        </div>
      
        <?php get_template_part('templates/components/related-products') ?>

    </section>
    <div class="page_footer" style="height: 460px;">
        <div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
    </div>
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>
<?php get_footer() ?>
<script>

</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>