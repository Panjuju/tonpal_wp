<?php
global $wp; // Class_Reference/WP 类实例
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');
$post = get_post();

$theme_vars = json_config_array('header','vars',1);
$product_detail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$product_detail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);

// weight
$theme_weight = json_config_array('header','widgets',1);


// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 主图处理
$photos = ifEmptyArray(get_post_meta(get_post()->ID,'photos'));
$photosArray = [];
foreach ($photos as $key=>$item){
    array_push($photosArray,json_decode($photos[$key],true));
}

// 当前页面url
$page_url = get_lang_page_url();

// pdf
$pdf = ifEmptyText(get_post_meta(get_post()->ID,'pdf',true));


$the_tags = get_the_tags( $post->ID ); // 获取当前产品的所有tags
$tags_array = [];
$exclude = array($post->ID); // 需要排除的id
$res_post = [];
foreach ($the_tags as $item ) { // 取出所有的tag的term_id
    array_push($tags_array,$item->term_id);
}
for ($i = 0; $i < count($tags_array); $i += 1 ) { // 循环所有的tag的term_id
    $related_posts = get_tags_relevant_product($tags_array[$i], $exclude,'info-product',5); // 根据tag的term_id获取相关产品
    $post_count = count(ifEmptyArray($related_posts)); // 统计获取到的产品数量
    if ($post_count > 0 && $post_count < 5) { // 当统计数在(1,5)时进入下一环节
        $num = 5 - $post_count; // 计算出需要补足的数量
        foreach( $related_posts as $item ) { // 将已获取的产品的id放入排除数组中
            array_push($exclude,$item->ID);
        }
        $recent_posts = get_category_new_product('info-product', $exclude, $num,'OBJECT'); // 获取需要补充的产品
        $res_post = array_merge($related_posts, $recent_posts); // 合并
        break;
    } elseif ($post_count == 5) { // 当计数为5时，已满足条件
        $res_post = $related_posts;
        break;
    }
}
if (empty($res_post)) { // 防止tags搜索不到数据时，补足五条
    $res_post = get_category_new_product('info-product', $exclude, 5, 'OBJECT');
}

$prev_post = get_previous_post(true);
$next_post = get_next_post(true);
?>
<style>
    .ct-inquiry-form {
  overflow: hidden;
  height: 460px;
  background-color: #f2f2f2;
  margin: 20px 0 !important;
  /* 背景图 */
  /* 发送表单 */
}
.ct-inquiry-form .send-bg {
  float: left;
  width: 400px;
  height: 100%;
}
.ct-inquiry-form .send-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.ct-inquiry-form .send-content {
  float: left;
  padding: 25px;

}
.ct-inquiry-form .send-content .inquiry-form-title {
  font-size: 23px;
  color: #2d2d2d;
}

.ct-inquiry-form .inquiry-form > ul {
  position: relative;
  height: 196px;
}
.ct-inquiry-form .inquiry-form .form-item {
  width: 1100px;
  height: 30px;
  margin-bottom: 18px;
  border: 1px solid #5b5b5b;
}
.ct-inquiry-form .inquiry-form .form-item input,
.ct-inquiry-form .inquiry-form .form-item textarea {
  width: 100%;
  height: 100%;
  border: none;
  text-indent: 10px;
}
.ct-inquiry-form .inquiry-form .form-item textarea {
  resize: none;
}
.ct-inquiry-form .inquiry-form .form-item-message {
  height: 60%;
  
  top: 0;
  right: 0;
}
.ct-inquiry-form .inquiry-form .form-btn-wrapx {
  padding-top: 83px;
}
.ct-inquiry-form .inquiry-form .form-btn-wrapx #customer_submit_button {
  width: 20%;
  height: 40px;
  line-height: 40px;
  text-align: center;
  color: #fff;
  font-weight: bold;
  border: none;
  background-color: red;
}
.page-contacts .blog-article::after {
  content: '';
  display: block;
  clear: both;
}
.page-contacts .blog-article .ct-inquiry-form {
  display: inline-block;
  width: auto;
  margin: 0 !important;
  height: 515px;
}
.page-contacts .blog-article .ct-inquiry-form .send-bg {
  display: none;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title {
  position: relative;
  padding-bottom: 25px;
  margin-bottom: 30px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title::after {
  position: absolute;
  bottom: 0;
  left: 0;
  content: '';
  display: block;
  width: 60px;
  height: 2px;
  background-color: #ffaa00;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form-title + p {
  display: none;
}
.page-contacts .blog-article .ct-inquiry-form .send-content {
  display: inline-block;
  padding: 20px 30px;
  padding-bottom: 0;
  width: 820px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form > ul {
  height: auto;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form li {
  position: static;
  width: 100%;
  height: 35px;
  margin-bottom: 20px;
  border-color: #8e8e8e;
  border-radius: 2px;
}
.page-contacts .blog-article .ct-inquiry-form .inquiry-form .form-item-message {
  height: 144px;
}
.page-contacts .blog-article .ct-inquiry-form .form-btn-wrapx {
  padding-top: 20px;
}
.page-contacts .blog-article .ct-inquiry-form .form-btn-wrapx #customer_submit_button {
  width: auto;
  padding: 0 20px;
  height: 35px;
  line-height: 35px;
  border-radius: 2px;
}
.page-contacts .left-form {
  float: left;
}
.page-contacts .right {
  float: left;
  padding-left: 40px;
  width: 330px;
}
.page-contacts .right p {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 5;
  line-height: 1.5;
  font-size: 15px;
  color: #2d2d2d;
}
.page-contacts .right li {
  position: relative;
  margin-top: 30px;
  font-size: 16px;
  color: #2d2d2d;
}
.page-contacts .right li img {
  position: absolute;
  top: 2px;
  left: 0;
  width: 27px;
  height: 20px;
  object-fit: contain;
}
.page-contacts .right li span {
  display: block;
  box-sizing: border-box;
  padding-left: 35px;
}
.page-contacts .main_content {
  padding-bottom: 20px;
}
.inquiry-form-wrap{
    position: relative;
    height: 420px! important;
    width: 100.5%! important;
    float: right! important;
}

</style>
<!DOCTYPE html>
<html lang="en">


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

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .main {
            width: 100%;
        }
        .prev a{
            text-decoration:underline
        }
        .next a{
            text-decoration:underline
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
    <section class="web_main page_main">
        <div class="layout">
            <div class="news-title border-bottom-2">
                <h1 class="page_title"><?php echo $post->post_title ?></h1>
            </div>
            <div class="iframe-box" style="height: 1500px;">
                <iframe src="/rec-product" style="width:100%;height:100%" frameborder="no" scrolling="no"></iframe>
            </div>
            <div class="page_footer">
                <div class="layout">
                    <?php get_template_part( 'templates/components/sendMessage-contanct' ); ?>
                </div>
            </div>
            <article class="entry blog-article">
                    <section class="mt15">
                        <?php echo $post->post_content ?>
                    </section>
                </article>
                <?php if (!empty($the_tags)) { ?>
                    <div class="tags underline"><h1>Tags:</h1>
                        <?php foreach ($the_tags as $item ) { ?>
                            <a style="text-decoration:underline"href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="chapter underline" style="font-size: 19px ;margin-top:20px">
                <?php
                // prev
                get_prev_or_next_post('prev', 'prev', 'Prev: ', '');
                // next
                get_prev_or_next_post('next', 'next', 'Next: ', '');
                ?>
            </div>
            <div class="main_hd" style="text-align: left;padding-top: 50px;">
                    <div class="page_title">
                        <h1  style="text-transform:capitalize;">
                            News Info Product
                        </h1>
                    </div>
                </div>
            <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post(); ?>
                            <li class="blog_item" style="overflow: hidden;margin-top: 10px;border-bottom: 1px dashed #ddd;">
                                    <figure class="item_wrap">
                                    <a href="<?php the_permalink(); ?>" class="item-img"><img src="http://q.zvk9.com/25826/2019/08/17/%E6%96%B0%E9%97%BB_3.jpg_thumb_262x135.jpg" style="float:left;margin-right: 20px;margin-bottom: 20px;" alt="" /></a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a style="font-size:18px" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><a href="<?php the_permalink(); ?>" class="item-more"></a></h3>
                                            <time style="font-size: 12px;color: #C0C0C0;"><?php echo esc_html( get_the_date() ); ?></time>
                                            <div class="item-detail" style="    height: 63px;"><?php the_excerpt(); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="item-more"><img style="position: relative;    left: 830px;top: -106px;width: 19px;"src="<?php echo get_template_directory_uri()?>/assets/images/news.png"></a>
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
       
    </section>
    <!--// main_content end -->
    <div class="contacts_footer">
        <div class="layout">
            <?php get_info_tags('',$category->term_id); ?>
        </div>
    </div>
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' )?>
</div>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
<script>
    $('.iframe-box iframe').eq(0).on('load',() => {
        $('.iframe-box iframe').eq(0).height($('.iframe-box iframe')[0].contentDocument.body.offsetHeight)
    })
</script>
</html>
