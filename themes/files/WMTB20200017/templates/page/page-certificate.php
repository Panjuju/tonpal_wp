<?php
// certificate.json -> vars 数据获取
$theme_vars = json_config_array('certificate', 'vars');

// Array 数据处理
$picturewell_item = ifEmptyArray($theme_vars['item']['value']);
// Text 数据处理
$picturewell_title = ifEmptyText($theme_vars['title']['value'], 'certificate');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
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
    <style>
        * {
  font-family: Arial !important;
}

/* 产品列表 */
.items_list .product_item {
  position: relative;
  padding: 0 15px;
}
.items_list .product_item figure {
  border: none;
}
.items_list .product_item figure:hover {
  box-shadow: none;
}
.items_list .product_item .item-img > img {
  width: auto;
  height: 523px;
  display: block;
  box-sizing: border-box;
  padding: 10px;
  margin: 0 auto;
  object-fit: cover;
}
.items_list .product_item .item-img a {
  border: 1px solid #c7c7c7;
}
.items_list .product_item .item-img span.ck {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background-color: #131313;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  z-index: 2;
  opacity: 0;
  cursor: pointer;
}
.items_list .product_item .item-img span.ck i {
  display: block;
  width: 50%;
  height: 50%;
  margin: 25%;
  background-position: center;
  background-repeat: no-repeat;
  -webkit-background-size: auto 26px;
  background-size: auto 26px;
  cursor: pointer;
}
.items_list .product_item .item-img::before,
.items_list .product_item .item-img::after {
  content: '';
  display: block;
  position: absolute;
  -webkit-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  z-index: 1;
}
.items_list .product_item .item-img::after {
  width: 40%;
  height: 40%;
  right: 0;
  bottom: 0;
}
.items_list .product_item .item-img::before {
  width: 30%;
  height: 50%;
  left: 0;
  top: 0;
}
.items_list .product_item .item-img:hover::before,
.items_list .product_item .item-img:hover::after {
  width: 100%;
  height: 100%;
  background-color: #000;
  opacity: 0.2;
}
.items_list .product_item .item-img:hover span.ck {
  opacity: 1;
  transform: scale(1.1);
}
.items_list .product_item h3 {
  text-align: center;
  font-size: 13px;
  color: #2d2d2d;
}
/* 公司荣耀 */
.page-certificate {
  padding-top: 40px;
}

        /* 图片遮罩 */
        #image_shadow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #101010;
            /* opacity: 0.9; */
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
      @media only screen and (max-width:767px){
        .items_list .product_item .item-img > img{
        width: auto;
        display: block;
        box-sizing: border-box;
        padding: 10px;
        height: 157.29px;
        margin: 0 auto;
        object-fit: cover;
        }
      }
    </style>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_template_part('header-list'); ?>
        <!--// header end  -->
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <div style="text-align:center;">
                <header class="main-tit-bar">
                <h2 class="hd_title" style="margin-top: 30px;"><?php echo $picturewell_title ?></h2>
                </header>
                </div>
                <div class="items_list page-certificate">
                    <ul class="gm-sep">
                        <?php foreach ($picturewell_item as $item) { ?>
                            <li class="product_item" style="margin-bottom: 20px;">
                                <figure class="item-wrap">
                                    <span class="item-img item_img">
                                        <a href="<?php echo ifEmptyText($item['image']) ?>" rel="<?php echo ifEmptyText($item['title']) ?>" title="<?php echo ifEmptyText($item['title']) ?>"></a>
                                        <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                                        <span class="ck certificate-fancy"><i style="background-image:url(<?php echo get_template_directory_uri() . '/assets/images/ceerificate-open.png' ?>)"></i> </span>
                                    </span>

                                    <figcaption class="item-info" style="margin-top: 20px;">
                                        <h3 class="item-title" style="overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                
            </div>
            <div class="layout" style="    margin-top: 30px;">
                        <?php get_template_part('templates/components/tags-random-product') ?>
                    </div>
        </div>
        <div class="page_footer" style="height: 460px;">
        <div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>
<div id="image_shadow">
    <div class="content"><a href="javascript:;"></a><img src="" alt=""></div>
</div>
<?php get_footer(); ?>

<script>
    // 弹出
    $('body').on('click', '.product_item .item_img .certificate-fancy', function() {
        let src = $(this).prev().attr('src')
        $('#image_shadow').show()
        $('#image_shadow img').attr('src', src)
    })
    // 关闭
    $('#image_shadow a').on('click', function() {
        $('#image_shadow').hide()
    })
</script>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>