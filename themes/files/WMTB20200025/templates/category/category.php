<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
// category.json -> vars 数据获取
$theme_vars = json_config_array_category('category', 'vars', $cat);
// Text 数据处理
$category_title = ifEmptyText($theme_vars['title']['value']);

$read_more = ifEmptyText(json_config_array('hearder', 'vars')['readBtn']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);

// 当前页面url
$category = get_category($cat);
$get_full_path = get_full_path();
$page_url = $get_full_path . get_category_link($category->term_id);
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

    <?php if ($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts(); ?>" />
    <?php } ?>
    <?php if ($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <div class="main_content category">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <?php if ($subName == '') { ?>
                        <header class="main-tit-bar">
                            <h1 class="title"><?php echo $category_title; ?></h1>
                        </header>
                    <?php } else { ?>
                        <header class="main-tit-bar">
                            <h3 class="title"><?php echo $category_title; ?></h3>
                            <h1><?php $subName; ?></h1>
                        </header>
                    <?php } ?>
                    <div class="blog_list">
                        <?php if (have_posts()) { ?>
                            <ul>
                                <?php while (have_posts()) : the_post();
                                    $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                ?>
                                    <li class="blog-item news-list-item">
                                        <!-- 有图显示，无图不显 -->
                                        <?php if (!empty($thumbnail)) { ?>
                                            <a class="item-img" style="width: 200px;height: 200px;line-height: 185px;" href="javascript:;">
                                                <img src="<?php echo $thumbnail  ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>">
                                            </a>
                                        <?php } ?>
                                        <figure class="item-wrap">
                                            <figcaption class="item-info">
                                                <h3 class="item-title">
                                                    <a href="<?php echo get_permalink(0); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <time datetime="<?php echo esc_html(get_the_date()); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                                <div class="item-detail"><?php the_excerpt(); ?></div>
                                                <a href="<?php echo get_permalink(0); ?>" class="item-more"><?php echo $read_more ?></a>
                                            </figcaption>
                                        </figure>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        <?php } else { ?>
                            <div class="row">
                                <div class="no-product"><?php echo $news_null_tip; ?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php get_template_part('templates/components/send-message'); ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--  footer end -->
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>