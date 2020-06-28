<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

// news.json -> vars 数据获取
$theme_vars = json_config_array('news','vars');
// Text 数据处理
$news_title = ifEmptyText($theme_vars['title']['value'],'News');
$news_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No News');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);


$sub_title = ifEmptyText(get_term_meta($cat,'sub_title',true)); // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$category = get_category($cat);
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);
?>


<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />

    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>

</head>
<style>
    .token{
        width: 100px;
    margin-left: 500px;
    }
    @media only screen and (max-width: 480px){
        .item_wrap img{
            width: 300px ! important;
            float: left;
    margin-right: 20px;

    height: 135px;
    margin-bottom: 20px;
        }
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
            <!-- main start -->
            <section class="main">
                <div class="blog_list">
                    <div class="page_title">
                        <div class="main_hd">
                        <div class="token">
                        <?php if ($sub_title == '') { ?>
                            <h2 class="hd_title" >
                                <?php echo $news_title; ?>
                            </h2>
                        <?php } else { ?>
                            <div class="h1-title" style="text-transform:uppercase" >
                                <?php echo $news_title; ?>
                            </div>
                            <h1 class="sub-title">
                                <?php echo $sub_title; ?>
                            </h1>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>
                
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true); ?>
                                <li class="blog_item" style="overflow: hidden;margin-top: 10px;border-bottom: 1px solid #ddd;">
                                    <figure class="item_wrap">
                                        <a href="<?php the_permalink(); ?>" class="item-img"><img src="<?php echo $thumbnail; ?>_thumb_262x135.jpg" style="float:left;margin-right: 20px;width: 265px;height: 135px;margin-bottom: 20px;" alt="<?php the_title(); ?>" /></a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a style="font-size:18px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 2; -webkit-box-orient: vertical;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a href="<?php the_permalink(); ?>" class="item-more"></a></h3>
                                            <time style="font-size: 12px;color: #C0C0C0;"><?php echo esc_html( get_the_date() ); ?></time>
                                            <div class="item-detail" style="    height: 63px;"><?php the_excerpt(); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="item-more"><img style="position: relative;left: 836px;top: -110px;width: 19px;"src="<?php echo get_template_directory_uri()?>/assets/images/news.png"></a>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <div class="page-bar">
                                <div class="pages"><?php wpbeginner_numeric_posts_nav(); ?>
                                </div>
                            </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product"><?php echo $news_null_tip; ?></div>
                        </div>
                    <?php } ?>
                    <div class="layout" style="margin-top: 40px;">
        <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
                <!--// sendMessage -->
            </section>
            <!--// main end -->
        </div>
    </section>
    <div class="page_footer" style="height: 460px;">
        <div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
    </div>
    <!--// page-layout end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
