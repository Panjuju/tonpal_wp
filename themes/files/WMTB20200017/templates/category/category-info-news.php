<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
$category = get_category($cat);

// SEO
$seo_title = ifEmptyText(get_term_meta($cat,'seo_title',true));
$seo_description = ifEmptyText(get_term_meta($cat,'seo_description',true));
$seo_keywords = ifEmptyText(get_term_meta($cat,'seo_keywords',true));

$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);


?>


<!doctype html>
<html lang="en">

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
    <style>
        .main{
            width: 100%;
        }
    </style>
</head>

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
                <div class="main_hd" style="text-align: center;">
                    <div class="page_title">
                        <h1 class="hd_title" style="text-transform:uppercase">
                            Info News
                        </h1>
                    </div>
                </div>
                <div class="news_list">
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post(); ?>
                            <li class="blog_item" style="overflow: hidden;margin-top: 10px;border-bottom: 1px solid #ddd;">
                                    <figure class="item_wrap">
 
                                        <figcaption class="item-info">
                                            <h3 class="item-title" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><a style="font-size:18px" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a href="<?php the_permalink(); ?>" class="item-more"></a></h3>
                                            <time style="font-size: 12px;color: #C0C0C0;"><?php echo esc_html( get_the_date() ); ?></time>
                                            <div class="item-detail" style="    height: 63px;"><?php the_excerpt(); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="item-more"><img style="position: relative;    left: 1100px;top: -110px;width: 19px;"src="<?php echo get_template_directory_uri()?>/assets/images/news.png"></a>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product">No News</div>
                        </div>
                    <?php } ?>
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
            <?php get_info_tags('',$category->term_id); ?>
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
