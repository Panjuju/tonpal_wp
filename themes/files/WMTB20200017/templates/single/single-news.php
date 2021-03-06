<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();

// 获取父级的背景图

$page_bg = ifEmptyText(get_post_meta(ROOT_CATEGORY_CID, 'background', true));
if (empty($page_bg)){
    $theme_vars = json_config_array('news','vars');
    $page_bg = ifEmptyText($theme_vars['image']['value']);
}
?>

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url;?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>

    </style>
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

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->
    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items">
                    <li class="head_bn_item swiper-slide"><img src="<?php echo $page_bg; ?>" alt=""></li>
                </ul>
            </div>
        </section>
    <?php } ?>
    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- main start -->
            <section class="main page_news" >
                <div class="news-title border-bottom-2" style="text-align: center;border-bottom: 1px #ddd solid;">
                    <h1><?php echo $post->post_title ?></h1>
                </div>
                <div class="news-time" style="text-align: center;color:#808080"><?php echo $post->post_date; ?></div>
                <article>
                    <?php echo $post->post_content ?>
                </article>
                <div class="chapter underline border-bottom-2">
                    <?php
                    // prev
                    get_prev_or_next_post('prev','prev','Prev: ','');
                    // next
                    get_prev_or_next_post('next','next','Next: ','');
                    ?>
                </div>
                <div class="layout"><h2 style="margin-bottom: 10px;margin-top: 10px;">TAGS</h2>
                        <?php get_template_part('templates/components/tags-random-product') ?>
        </div>
      
        <?php get_template_part('templates/components/related-products') ?>

            </section>
            <!--// main end -->
        </div>
        <div class="layout">
                        <?php get_template_part('templates/components/tags-random-product') ?>
                    </div>
    </section>
    <!--// page-layout end -->
    <div class="page_footer" style="height: 460px;">
        <div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
    </div>
    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->

</div>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
