<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/common.js"></script>


<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.cookie.js"></script>

<!-- 客服栏 -->
<script>
    var kf_template = `<div style="position: fixed;z-index:99999;bottom:180px;right:20px">
    <div id="kefu-icon" onclick="showPanel()" style="width: 55px;height: 55px;line-height: 50px;text-align: center;border-radius: 50%;background:#c4c7cc;box-shadow: -1px 2px 10px 2px #c4c7cc;">
        <img src="https://t1.picb.cc/uploads/2020/06/12/ti6FWi.png" alt="" style="width: 25px;">
    </div>

    <div id="kefu-panel" style="display:none;background:#c4c7cc;width:200px;padding: 15px 20px;border-radius: 15px;">
        {$kefu-panel}
        <div onclick="closePanel()" style="position: absolute;right: 10px;bottom: -30px;width: 20px;height: 20px;">
            <div style="width: 20px;height: 2px;background-color: #999;transform: rotate(45deg);position: absolute;right: 0;bottom:9px"></div>
            <div style="width: 20px;height: 2px;background-color: #999;transform: rotate(-45deg);position: absolute;right: 0;bottom:9px"></div>
        </div>
    </div>
</div>`;

    $(function() {

        var data = [{
                'icon': "https://t1.picb.cc/uploads/2020/06/12/ti6FWi.png",
                'name': "Skype",
                "link": "http://www.baidu.com"
            },
            {
                'icon': "https://t1.picb.cc/uploads/2020/06/12/ti6FWi.png",
                'name': "test",
                "link": ""
            }
        ];

        var kefu_panel = `<div onclick="window.open('$link','_blank');" style="background:#0595c7;padding: 5px 10px;border-radius: 10px;font-size: 18px;$margin">
            <img style="width: 20px;vertical-align: middle;" src="$icon" alt="">
            <span style="vertical-align: middle;margin-left: 10px;color: #fff;">$name</span>
        </div>`

        var kefu_item = ''

        for (let i = 0; i < data.length; i++) {
            const element = data[i];

            var result_map = {
                "$icon": element['icon'],
                "$name": element['name'],
                "$link": element['link'],
                "$margin": "margin-bottom:15px"
            }

            if (i == data.length - 1) {
                result_map['$margin'] = '';
            }

            var tem_html = kefu_panel.replace(/(\$icon)|(\$name)|(\$link)|(\$margin)/g, reg => (result_map[reg]));
            kefu_item += tem_html
        }

        kf_template = kf_template.replace('{$kefu-panel}', kefu_item)

        $("body").append(kf_template);

    })

    function showPanel() {
        $("#kefu-icon").hide()
        $("#kefu-panel").show()
    }

    function closePanel() {
        $("#kefu-icon").show()
        $("#kefu-panel").hide()
    }
</script>

<script>
    // 点击展开
    $('body').on('click', '.content-wrap .zz', function() {
        var subMenu = $(this).parent().find('.sub-menu')
        if (subMenu.length !== 0) {
            subMenu.toggleClass('active')
        }
    })

    $('body').on('click', '.mobile-head-items .title', function() {
        if ($('.content-wrap>ul>li .zz').length != 0) return;

        $('.content-wrap>ul>li').each(function() {
            if ($(this).find('.sub-menu').length != 0) {
                $(this).append('<b class="zz">+</b>')
            }
        })
    })
    // 顶部导航 点击存id
    $('.head_nav li').on('click', function() {
        window.localStorage.setItem('pageId', $(this).attr('id'))
    })
    $(function() {
        // 找一级 父链接
        var zsj = function(ele) {
            if (ele.parent().hasClass('head_nav')) {
                return ele
            }
            return zsj(ele.parent())
        }
        var pageId = window.localStorage.getItem('pageId')
        if (pageId == null) return

        var target = zsj($(`#${pageId}`))

        var pageUrl = '/' + (window.location.href).replace('http://', '').replace('https://', '').split('/')[1] || '/'
        // console.log(pageUrl)
        if (pageUrl != target.find('a').attr('href')) return
        $(target.find('a')[0]).css('color', '#fff500')
    });
</script>
<script>
    // 新闻详情 多了一级面包屑
    $($('.path_bar ul li')[2]).hide()
</script>

