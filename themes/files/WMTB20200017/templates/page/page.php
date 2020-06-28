<?php

// page.json -> vars 数据获取
$theme_vars = json_config_array_category('page','vars',$post->ID);
// Text 数据处理
$page_title = ifEmptyText($theme_vars['title']['value']);


$page_rich_text = ifEmptyText($theme_vars['richText']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part( 'templates/components/head' )?>
</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_template_part('header-list'); ?>
    <!--// web_head end -->

   
    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- main start -->
            <section class="main public_page" >
                <header class="title">
                    <h1><?php echo $page_title ?></h1>
                </header>
                <article class="blog-article">
                    <?php echo $page_rich_text; ?>
                </article>
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
<!-- 微数据 -->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
