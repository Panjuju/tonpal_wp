<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video', 'vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'], 'video');
$video_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$video_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$page_data = $video_item;
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
        .items_list {
            padding-top: 50px;
        }

        .product-item.video-list {
            margin: auto;
        }

        .product-item.video-list .item-title {
            font-size: 16px;
            color: #2d2d2d;
            height: 50px;
            line-height: 50px;
            text-indent: 9px;
        }

        .product-item.video-list .item-img {
            width: 550px;
            height: 330px
        }
        .json_page {
  height: 33px;
  line-height: 33px;
  text-align: center;
  font-size: 12px;
  margin: 20px 0;
}
.json_page ul {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
}
.json_page li {
  display: inline-block;
  background: #fff;
  border: 1px solid #c5c5c5;
  color: #2c2c2c;
  min-width: 33px;
  padding: 0 5px;
  cursor: pointer;
  margin-left: 5px;
  user-select: none;
}
.json_page li:first-child,
.json_page li:last-child {
  width: 80px;
}
.json_page li:hover,
.json_page li.current {
  color: #fff;
  border-color: #ffaa00;
  background-color: #ffaa00;
}
.json_page li.current + .j_next {
  display: none;
}
.json_page li.j_previous.hide {
  display: none;
}
#json_page_list > ul {
  height: 0;
  visibility: hidden;
  opacity: 0;
}
#json_page_list > .current {
  height: auto;
  visibility: visible;
  opacity: 1;
}

@media only screen and (max-width: 950px){
.items_list ul {
    padding-top: 0;
    display: grid ! important;
}
.product-item.video-list .item-img{
  
    width: 300% ! important;
    height: auto ! important;
}
}
@media only screen and (max-width: 768px){
    .product-item.video-list .item-img {
    width: 250% ! important;
    margin-left: 27% !important;
    height: 300px ! important;
}
.product-item.video-list .item-title{
    text-align: center;
    font-size: 16px;
    color: #2d2d2d;
    height: 50px;
    line-height: 50px;
    text-indent: 9px;
}
}
@media only screen and (max-width: 480px){
    .product-item.video-list .item-img {
    width: 300% ! important;
    height: auto ! important;
    margin-left: 0 !important;
}}

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
                <div class="main_hd" style="text-align: center;margin-top:40px">
                <header class="main-tit-bar">
                    <h2 class="hd_title"><?php echo $video_title; ?></h2>
                </header>
                </div>
                <div class="items_list" id="json_page_list">
                    <ul class="gm-sep current" id="wm-page">
                    <?php /*foreach ($video_item as $item) { ?>
                            <li class="product-item video-list" style="float: left;margin-right: 10px;margin-left: 10px;">
                                <figure class="item-wrap">
                                    <div class="item-img">
                                        <?php echo $item['iframe'] ?>
                                    </div>
                                    <figcaption class="item-info">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </figcaption>
                                </figure>
                            </li>
                            <?php } */?>  
                    </ul>
                </div>
                <div class="layout" style="margin-top: 40px;">
                        <?php get_template_part('templates/components/tags-random-product') ?>
                    </div>               
            </div>          
        </div>
        <!--// main_content end --><div class="page_footer" style="height: 460px;">
<div class="layout" style="height:100%;width:100%">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
        </div>
    </div>
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<script>

</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>
<!-- 分页 -->
<script>
    var all_data = []; //全部数据
    var current = 1;   //当前页码
    var per_page = 4; //每页码数
    var all_page = 1;  //总页数
    var render_dom = "wm-page"; //渲染dom
    var pagination = []; //分页数据
    
    //渲染模板
    var template = `
    
                        <li class="product-item video-list" style="float: left;margin-right: 10px;margin-left: 10px;">
                                <figure class="item-wrap">
                                    <div class="item-img">
                                    <$iframe/>
                                    </div>
                                    <figcaption class="item-info">
                                        <h3 class="item-title"><$title/></h3>
                                    </figcaption>
                                </figure>
                            </li>
            `;


    window.onload = function() {
        console.log("开始")
        all_data = <?php echo json_encode($video_item) ?>;
        var key = 0; //分页key
        var temp = [];
        for (var i = 0; i < all_data.length; i++) {
            if (i % per_page > 0) {
                pagination[key].push(all_data[i])
            } else {
                key = i / per_page
                pagination[key] = pagination[key] == "undefined" ? pagination[key] : []
                pagination[key].push(all_data[i])
            }
        }
        all_page = pagination.length //总页数
        pageTo() //初始化渲染
    }

    function pageTo(page = 1) {
        current = page
        rernderHtml(current - 1)
        renderPagination()
    }

    function rernderHtml(page) {
        var html = '';
        var list = pagination[page]
        for (let index = 0; index < list.length; index++) {

            var result_map = {
                "<$iframe/>": list[index]['iframe'],
                "<$title/>": list[index]['title']
               
            }

            tem_html = template.replace(/(<\$title\/>)|(<\$iframe\/>)/g, reg => (result_map[reg]));
            html += tem_html

        }
        var parent_dom = document.getElementById(render_dom)
        parent_dom.innerHTML = html
        window.scrollTo(0,0)
    }

    function renderPagination() {
        let parent_html = `
        <div class="page_bar" style="float:right">
            <div class="pages">
                <a href="javascript:;" onclick="pageTo(1)">Head</a>
                <$page/>
                <a href="javascript:;" onclick="pageTo(` + all_page + `)">Foot</a>
            </div>
        </div>`

        let page_html = ''

        if (current > 1) {
            page = current - 1
            var temp = '<a href="javascript:;" onclick="pageTo(' + page + ')">PREVIOUS</a>'
            page_html += temp
        }

        for (let index = 0; index < pagination.length; index++) {
            let current_class = '';
            if ((index + 1) == current) {
                current_class = "current"
            }
            let page = index + 1
            var temp = '<a class="' + current_class + '" href="javascript:;" onclick="pageTo(' + page + ')">' + page + '</a>'
            page_html += temp
        }

        if (current < all_page) {
            page = current + 1
            var temp = '<a href="javascript:;" onclick="pageTo(' + page + ')">NEXT</a>'
            page_html += temp
        }

        parent_html = parent_html.replace("<$page/>", page_html)

        document.getElementById("pagination").innerHTML = parent_html
    }
</script>

</html>