<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase','vars');

// Array 数据处理
$showcase_item = ifEmptyArray($theme_vars['item']['value']);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'],'showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$showcase_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>
    <style type="text/css">
    .product-item {
	position: relative;
}

.product-item::before {
	content: '';
	position: absolute;
	
	left: 8px;
	width: 3px;
	height: 85%;
	background-color:#e7ebed;
}
.product-list{margin-top:20px;}
.product-list .product-item{width:90%; margin-right: 0}
.product-item .item-wrap{width: 100%}
.product-item .item-img img{width: 100%}
  .product-item .item-wrap .item-info{margin-top:10px; height:40px; line-height: 20px; margin-bottom: 10px;}
  @media screen and (max-width: 630px){
    .product-list .product-item {
        width: 98%;
        margin-bottom: 20px !important;
        padding-left:10px;
        break-inside: avoid;
    }
    .gm-sep{
    column-count: 1 ! important; column-gap: 1px;
}
  }
  .product-list ul {
    position: relative;
    width: 100%;
}
.main .product-item{
    padding-left:33px;
    break-inside: avoid;
}
.gm-sep{
    column-count: 3; column-gap: 1px;
}
   /* 图片遮罩 */
   #image_shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #101010;
            opacity: 0.9;
            cursor: pointer;
            z-index: 1000;
            display: none;
        }

        #image_shadow .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            border-width: 10px;
            width: 1024px;
            height: 683px;
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
            opacity: 1;
        }

        #image_shadow .content a {
            position: absolute;
            top: -15px;
            right: -15px;
            z-index: 1002;
            width: 30px;
            height: 30px;
            background: transparent url("<?php echo get_template_directory_uri() ?>/assets/images/fancybox.png") -29px 0px;
        }

        #image_shadow .content img {
            height: 100%;
            width: auto;
            display: block;
            margin: 0 auto;
        }
        .main_content .hd_title{display: inline-block;text-transform: uppercase;font-weight: normal;}
			.main_content .hd_title:after {
				content: '';
				display: block;
				width: 32px;
				height: 4px;
				background-color: #df0000;
				margin: 3px auto 0;
      }
</style>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_template_part('header-list'); ?>
    <!--// header end  -->
    <!-- path -->
    <nav class="path-bar">
            <?php get_breadcrumbs(); ?>
        </nav>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!-- main begin -->
            <section class="main" >
            <div class="main_hd" style="text-align: center;"> 
                <header class="main-tit-bar" style="margin-top: 20px;">
                    <h2 class="hd_title"><?php echo $showcase_title ?></h2>
                </header>
            </div>
                <?php if($showcase_desc != ''){ ?>
                    <p class="class-desc" style="margin-top: 10px;line-height:1.5"><?php echo $showcase_desc ?></p>
                <?php } ?>
                <div class="product-list case_list">
                <ul class="gm-sep showcase-list" id="masonry" >
                        <?php foreach ($showcase_item as $item) { ?>
                            <li class="product-item" style="border: 1px solid #ddd;padding: 18px;margin-bottom: 15px;" >
                            <figure class="item-wrap">
                                <a  href="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/ceerificate-open.png' ?>)"rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title'])?>" />
                                <span class="ck certificate-fancy"><i style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/ceerificate-open.png' ?>)"></i> </span>
                                </a>
                                <div class="main_hd">
                                <figcaption class="item-info">
                                <h2 class="item-title hd_title" style="text-align:left"><a href="" class="limit-2-line"><?php echo ifEmptyText($item['title']) ?></a></h3>
                                </figcaption>
                                </div>
                                <figcaption class="item-info">
                                <p style="text-align:left"><a href="" class="limit-3-line"><?php echo ifEmptyText($item['desc']) ?></a></p>
                                </figcaption>
                            </figure>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!--// main end -->
        </div>
        <div class="layout">
                        <?php get_template_part('templates/components/tags-random-product') ?>
                    </div>
        <div class="page_footer" style="height: 460px;">
        <div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
    </div>
    <!--// main_content end -->

    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>

<script>
    $('body').append(`
    <style>
        /* 图片遮罩 */
        #image_shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #101010;
            opacity: 0.9;
            cursor: pointer;
            z-index: 1000;
            display: none;
        }

        #image_shadow .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            border-width: 10px;
            width: 1024px;
            height: 683px;
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
            opacity: 1;
        }

        #image_shadow .content a {
            position: absolute;
            top: -15px;
            right: -15px;
            z-index: 1002;
            width: 30px;
            height: 30px;
            background: transparent url("<?php echo get_template_directory_uri() ?>/assets/images/fancybox.png") -30px 0px;
        }

        #image_shadow .content img {
            height: 100%;
            width: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
    <div id="image_shadow">
        <div class="content"><a href="javascript:;"></a><img src="" alt=""></div>
    </div>
    `);
    // 弹出 
    $('body').on('click', '.item-wrap img', function() {
        let src = $(this).attr('src')

        // 显示遮罩层
        $('#image_shadow').show()
        $('#image_shadow img').attr('src', src)
    })
    // 关闭
    $('body').on('click', '#image_shadow a', function() {
        $('#image_shadow').hide()
    })
</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

