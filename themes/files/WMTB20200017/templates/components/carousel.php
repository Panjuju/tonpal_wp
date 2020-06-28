<?php if ($home_carousel['display'] == 1) {
            $home_carousel_items = ifEmptyArray($home_carousel['vars']['items']['value']);
            ?>
            <section class="slider_banner">
                <div class="swiper-wrapper">
                    <?php foreach ($home_carousel_items as $item ) { ?>
                        <div class="swiper-slide" style="width: 100%;max-height:525px; padding-bottom: 30%; position: relative; display: inline-block">
                            <a href="<?php echo ifEmptyText($item['link'],'javascript:;');?>">
                                <img style="position: absolute; width: 100%; height: 100%; object-fit: cover;top: 0; left: 0" src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']); ?>" title="<?php echo ifEmptyText($item['title']); ?>" />
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="slider_swiper_buttons index_swiper_control">
                    <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
                    <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
                </div>
                <div class="slider_swiper_control">
                    <div class="swiper-pagination swiper-pagination-white"></div>
                </div>
            </section>
        <?php } ?>
