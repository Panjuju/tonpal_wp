<?php
// products.json -> vars 数据获取
$theme_vars = json_config_array('products','vars');
$page_bg = ifEmptyText($theme_vars['image']['value']);
if ( have_posts() ) {
    $product_item = [];
    $keywords = get_query_var('s');
    $term_id = get_category_by_slug("product")->term_id;
    $wp_query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $term_id,   // 指定分类ID
        's'=>$keywords,
        'meta_key' => 'list_order',/* 此处为你的自定义栏目名称 */
        'orderby' => 'list_order', /* 配置排序方式为自定义栏目值 */
        'order' => 'DESC', /* 降序排列 */
        'caller_get_posts' => 1,
    ]);

    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true);
        $post->thumbnail = $thumbnail;
        array_push($product_item,$post);
    }
    wp_reset_query(); // 重置query 防止影响其他query查询
}
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $keywords; ?></title>
    <?php get_template_part('templates/components/head'); ?>

    <style>
        .category-product .items_list {
            margin-top: 65px;
        }
    </style>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_template_part('header-list'); ?>
    <!--// header end  -->
    <!-- path -->
    
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <section class="web_main page_main page_list">
        <div class="layout">
            <!--// aisde end -->
            <!-- main begin -->
            <section class="main" style="padding-bottom: 0px;">
                <div class="main_hd" style="text-align: center;">
                    <div class="page_title">
                        <h1 class="hd_title" style="text-transform:uppercase">Search Results</h1>
                    </div>
                </div>
                <!-- product list -->
                <div class="product_slider">
                        <div class="swiper-container">
                    <?php if ( $product_item != [] ) { ?>
                        <ul class="product_items" style="margin-top: 30px;">
                            <?php foreach ($product_item as $item ) { ?>
                                <li class="product_item wow fadeInLeftA">
                                            <figure>
                                                <span class="item_img">
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
                    <?php } else { ?>
                        <ul>
                            <li class="product-item">
                                No Products!
                            </li>
                        </ul>
                    <?php } ?>
                </div>
                </div>
                <div class="layout">
                        <?php get_template_part('templates/components/tags-random-product') ?>
                    </div>
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
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>

</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

