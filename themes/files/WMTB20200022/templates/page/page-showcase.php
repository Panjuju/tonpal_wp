<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase','vars');

// Array 数据处理
$showcase_item = ifEmptyArray($theme_vars['item']['value']);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'],'showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');

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
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!-- main begin -->
            <section class="main" >
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $showcase_title ?></h1>
                </header>
                <?php if($showcase_desc != ''){ ?>
                    <p class="class-desc" style="margin-top: 10px;line-height:1.5"><?php echo $showcase_desc ?></p>
                <?php } ?>
                <div class="items_list">
                    <ul class="gm-sep showcase-list">
                        <?php foreach ($showcase_item as $item) { ?>
                        <li class="product-item">
                            <figure class="item-wrap">
                                <a href="<?php echo ifEmptyText($item['image']) ?>" rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title'])?>" />
                                </a>
                                <figcaption class="item-info">
                                    <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                </figcaption>
                            </figure>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!--// main end -->
        </div>
    </div>
    <!--// main_content end -->

    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>
<script type="text/javascript">
    $('.certificate-fancy').fancybox({
        afterLoad : function() {
            //this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            this.title = this.title ? this.title : '';
        },
        helpers     : {
            title   : { type : 'inside' },
            buttons : {}
        }
    });
</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

