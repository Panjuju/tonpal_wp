<style>
   
    .tag_list a:hover{
				background-color: #df0000 ! important;
    color: #fff ! important;
			}
</style>
<?php
if( is_single() ) {
    if (ROOT_CATEGORY_SLUG == 'product') {
        $term_id = ROOT_CATEGORY_CID;// 父级ID
    } else {
        $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    }
} elseif ( is_category() ) {
    $term_id = get_category($cat)->term_id;
    $pid = get_category_root_id($term_id);
    $the_slug = get_category($pid)->slug;
    if ($the_slug == 'news') {
        $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    }
} else {
    $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
}
$tags = get_random_tags($term_id,5); // 随机获取当前分类的tags
if ( ifEmptyArray($tags) !== [] ) { ?>
    <ul class="tag_list">
        <li >
            <?php foreach ($tags as $item ) { ?>
                <a class="tag_item" style="display: inline-block;padding: 8px 15px;color: #555;background: #fff;"href="<?php echo get_tag_link($item->term_id) ?>" ><?php echo $item->name?></a>
            <?php } ?>
        </li>
    </ul>
<?php } ?>
