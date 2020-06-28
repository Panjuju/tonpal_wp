<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
global $cat; // Class_Reference/WP 类实例
// products.json -> vars 数据获取
$theme_vars = json_config_array('products', 'vars');

// Text 数据处理

$products_header_desc = ifEmptyText(get_term_meta($cat, 'header_desc', true));
$products_header_desc = 'The whole stamping rainproof roof is equipped with transparent glass cover, which makes the view open and bright.The whole stamping rainproof roof is equipped with transparent glass cover, which makes the view open and bright.The whole stamping rainproof roof is equipped with transparent glass cover, which makes the view open and bright.The whole stamping rainproof roof is equipped with transparent glass cover, which makes the view open and bright.';



$sub_title = ifEmptyText(get_term_meta($cat, 'sub_title', true)); // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称

$products_subtitle = ifEmptyText(get_term_meta($cat, 'subtitle', true));
if (empty($products_subtitle)) {
    $products_subtitle = ifEmptyText($theme_vars['subtitle']['value']);
}

// SEO
$seo_title = ifEmptyText(get_term_meta($cat, 'seo_title', true));
if (empty($seo_title)) {
    $seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
}
$seo_description = ifEmptyText(get_term_meta($cat, 'seo_description', true));

if (empty($seo_description)) {
    $seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
}

$seo_keywords = ifEmptyText(get_term_meta($cat, 'seo_keywords', true));
if (empty($seo_keywords)) {
    $seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
}
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
$max = intval($wp_query->max_num_pages);

// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path . get_category_link($category->term_id);

// 当前是第几页
$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

// 产品列表数据
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => $paged,
    'cat' => $cat,   // 指定分类ID
    'posts_per_page' => get_posts_per_page_num(), /* 显示几条 */
    'meta_key' => 'list_order',/* 此处为你的自定义栏目名称 */
    'orderby' => 'list_order', /* 配置排序方式为自定义栏目值 */
    'order' => 'DESC', /* 降序排列 */
    'caller_get_posts' => 1,
);
$product_posts_items = query_posts($args);
wp_reset_query(); // 重置query 防止影响其他query查询

?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?><?php if ($paged > 1) printf('–%s', $paged); ?></title>
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

    <style>
        .category-product .items_list {
            margin-top: 65px;
        }

        .token {
            text-align: center;
        }
        @media only screen and (max-width:480px){
            .product_items .product_item .item_img{
            border: 2px solid #ddd;
            height:141px ! important;
            }
        }
        @media only screen and (max-width:768px){
            .product_items .product_item .item_img{
            border: 2px solid #ddd;
            height:141px ;
            }
        }
        @media only screen and (max-width:1024px){
            .product_items .product_item .item_img{
            border: 2px solid #ddd;
            height:350px ;
            } 
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_template_part('header-list'); ?>
        <!--// header end  -->
        
        <?php get_breadcrumbs(); ?>
        <!-- page-layout start -->
        <section class="web_main page_main page_list">
            <div class="layout">

                <!-- main start -->
                <section class="main category-product">
                    <div class="main_hd">
                        <div class="page_title" style="padding-bottom:0px;margin: 0 0 5px;">
                            <div class="token">
                                <?php if ($sub_title == '') { ?>
                                    <h2 class="hd_title" >
                                        <?php echo $the_category_name; ?>
                                    </h2>
                                <?php } else { ?>
                                    <div class="h1-title" style="text-transform:uppercase">
                                        <?php echo $the_category_name; ?>
                                    </div>
                                    <h1 class="sub-title">
                                        <?php echo $sub_title; ?>
                                    </h1>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="page_desc" style="    padding-bottom: 10px;">                      
                            <p class="main_intro" style="text-align: center;font-size: 12px;color: #C0C0C0;"><?php echo $products_subtitle; ?></p>
                    </div>
                    <div class="page_desc">
                        <?php if ($products_header_desc !== '') { ?>
                            <p class="main_intro"><?php echo $products_header_desc; ?></p>
                        <?php } ?>
                    </div>
                    <div class="product_slider">
                        <div class="swiper-container">

                            <?php if (ifEmptyArray($product_posts_items) !== []) { ?>
                                <ul class="product_items" style="margin-top: 30px;">
                                    <?php
                                    foreach ($product_posts_items as $key => $item) {
                                        $thumbnail = get_post_meta($item->ID, 'thumbnail', true);
                                    ?>
                                        <li class="product_item wow fadeInLeftA">
                                            <figure>
                                                <span class="item_img" style="    height: 262px;">
                                                    <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $item->post_title; ?>" />
                                                    <a href="<?php echo get_permalink($item->ID); ?>"></a>
                                                </span>
                                                <figcaption>
                                                    <h3 class="item_title">
                                                        <a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                                    </h3>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="page-bar">
                                    <div class="pages"><?php wpbeginner_numeric_posts_nav(); ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                               
                            <?php } ?>

                        </div>
                    </div>
                    <div class="layout">
                        <?php get_template_part('templates/components/tags-random-product') ?>
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
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

