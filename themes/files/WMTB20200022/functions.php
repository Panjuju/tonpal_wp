<?php
use library\Db;

if (!function_exists('my_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function my_theme_setup()
    {
        //注册菜单
        register_nav_menus(
            array(
                'primary' => __('主导航栏'),
                'footer' => __('底部菜单')
            )
        );

    }

    function init_theme_file()
    {
        $jsonDir = get_template_directory() . '/json';
        $temp = scandir($jsonDir);
        foreach($temp as $key => $parentDir)
        {
            if($parentDir != '.' && $parentDir != '..'){

                if(is_dir($jsonDir.'/'.$parentDir)){
                    $sonTemp = scandir($jsonDir.'/'.$parentDir);

                    foreach($sonTemp as $k => $value)
                    {
                        $json_dir = $jsonDir.'/'.$parentDir.'/'.$value;
                        if(is_file($json_dir))
                        {
                            $item = get_json_toArray($json_dir);
                            $filename = explode('.',$value);
                            if(is_array($filename) && count($filename) > 0)
                            {
                                $filename = $filename[0];
                            }
                            $filename = $parentDir. '/' .$filename;
                            global $wpdb; // Class_Reference/wpdb 类实例
                            $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}theme_file WHERE file = %s ",$filename ) );

                            $data = [
                                'is_public' =>  strpos($item['action'],'public') !==false  ? 1 : 0,
                                'theme' => wp_get_theme()->get('Name'),
                                'name' => $item['name'],
                                'action' => $item['action'],
                                'file' => $filename,
                                'description' => $item['description'],
                                'more' => json_encode($item ),
                                'config_more' => json_encode($item)
                            ];

                            if(empty($result))
                            {
                                //新增
                                $wpdb->insert($wpdb->theme_file,$data);
                            }
                            else{
                                $res = $wpdb->update($wpdb->theme_file,$data,['id' => $result->id]);
                            }
                        }

                    }
                }
            }
        }

    }

endif;
add_action('after_setup_theme', 'my_theme_setup');

add_action('init', function(){
    do_action('lang_loaded');
});


//添加模板css样式
function add_theme_scripts()
{
    //引入jquery依赖
    wp_enqueue_script('jQuerytest',get_template_directory_uri() . '/assets/plugins/jQuery/jquery.min.js');
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

// 获取根分类id
function get_category_root_id($cat)
{
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $this_category->term_id; // 返回根分类的id号
}

/**
 * 获取各级父级url 和 name
 * $cat 当前id
 * @author zhuoyue
 */
function get_category_url_and_name($cat)
{
    $category_url_array = [];
    $get_full_path = get_full_path();
    $this_category = get_category($cat); // 取得当前分类
    array_push($category_url_array,array(
        'name' => $this_category->name,
        'link' => $get_full_path.get_category_link($this_category->term_id)
    ));

    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
        array_push($category_url_array,array(
            'name' => $this_category->name,
            'link' => $get_full_path.get_category_link($this_category->term_id)
        ));

    }
    return $category_url_array; // 返回根分类的id号
}

add_filter('nav_menu_css_class','init_menu_items_class',1,3);

function init_menu_items_class($classes, $item, $args) {
    if($args->theme_location == 'primary') {

        if($item->menu_item_parent == 0)
        {
            $classes[] = 'nav-item';
        }

        if(in_array('menu-item-has-children',$classes))
        {
            $classes[] = 'view';
        }

    }
    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'init_menu_link_attributes', 2, 3 );
/**


 */
function init_menu_link_attributes( $atts, $item, $args ) {
    if($args->theme_location == 'primary') {

        $atts['class'] = 'nav-link';
        if(in_array('menu-item-has-children',$item->classes))
        {
            $atts['class'] = 'nav-link dropdown-toggle';
        }

        if($item->menu_item_parent != 0)
        {
            $atts['class'] = 'dropdown-item';
        }

        return $atts;
    }
}


add_filter( 'nav_menu_submenu_css_class', 'init_submenu_class', 3, 3 );
function init_submenu_class( $classes, $item, $args ) {
    $classes[] = 'subnav';
    return $classes;
}

//读取json配置文件并生成array
function get_json_toArray($dir){
    $json = file_get_contents($dir);
    $data = json_decode($json,true);
    return $data;
}

//根据当前文件全局获取配置文件变量
function json_config_array($file,$type = 'vars',$public = 0)
{

    $filename = explode('.',basename($file));
    if(is_array($filename) && count($filename) > 0)
    {
        $filename = $filename[0];
    }
    $file = $public ? 'public/'.$filename : 'portal/'.$filename;


    global $wpdb; // Class_Reference/wpdb 类实例
    $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}theme_file WHERE file = %s AND is_public = %d LIMIT 1",$file, $public ) );

    if($result !== false)
    {
        $result = (array)$result;
        $more = json_decode($result['more'],true);
        $config_more = json_decode($result['config_more'],true);

        if(isset($config_more['more'][$type])){
            $data = $config_more['more'][$type];
            return $data;
        }
    }
}
//根据当前文件全局获取配置文件变量
function json_config_array_category($file,$type = 'vars',$object_id)
{
    $file = 'portal/'.$file;
    global $wpdb; // Class_Reference/wpdb 类实例
    $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}theme_file WHERE file = %s AND is_public = %d AND object_id = %d LIMIT 1",$file, 0, $object_id ) );
    if($result !== false)
    {
        $result = (array)$result;
        $more = json_decode($result['more'],true);
        $config_more = json_decode($result['config_more'],true);

        if(isset($config_more['more'][$type])){
            $data = $config_more['more'][$type];
            return $data;
        }
    }
}
/**
 * ifEmptyText [字符判空]
 * @param $value [需要进行判空的值] [必传]
 * @param $default [默认值]
 * @author zhuoyue
 */
function ifEmptyText ($value,$default = '') {
    $data = isset($value) ? (!empty($value) ? $value : $default) : $default;
    return $data;
}

/**
 * ifEmptyText [数组判空]
 * @param $value [需要进行判空的值] [必传]
 * @param $default [默认值]
 * @author zhuoyue
 */

function ifEmptyArray ($value,$default = []) {
    $data = isset($value) ? (!empty($value) ? $value : $default) : $default;
    return $data;
}
/** 分页器 */
function wpbeginner_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query; // Class_Reference/WP_Query 类实例

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    if ($max <= 10 ) {
        for ($i = 1;$i<=$max;$i+=1) {
            $links[] = $i;
        }
    } else {
        if ($paged > 6) {
            $add = $paged + 4;
            $dec = $paged - 5;
            $min_num = $max >= $add ? ($dec > 1 ? $dec : 1 ) : $max - 9;
            $max_num = $max >= $add ? $add : $max ;
            for ($i = $min_num;$i<=$max_num;$i+=1) {
                $links[] = $i;
            }
        }else{
            for ($i = 1;$i<=10;$i+=1) {
                $links[] = $i;
            }
        }
    }


    echo '<div class="page-bar"><div class="pages">' . "\n";
    // 首页
    echo '<a href="'.get_pagenum_link(1).'">Head</a>'. "\n";
    // 上一页
    if ( get_previous_posts_link() ) printf( get_previous_posts_link('Prev') );

    foreach ( (array) $links as $item ) {
        $class = $paged == $item ? ' class="active"' : '';
        printf( '<a %s href="%s">%s</a>' . "\n", $class, esc_url( get_pagenum_link( $item ) ), $item );
    }

    // 下一页
    if ( get_next_posts_link() ) printf( get_next_posts_link('Next') );
    // 尾页
    echo '<a href="'.get_pagenum_link($max).'">Foot</a>'. "\n";
    echo '</div></div>' . "\n";

}

// 面包屑
function get_breadcrumbs()
{
    global $wp_query; // Class_Reference/WP_Query 类实例

    if ( !is_home() ){

// Start the UL
        echo '<nav class="path-bar">';
        echo '<ul class="path-nav">';
// Add the Home link
        echo '<li><a class="home" href="'. get_lang_home_url() .'">Home</a></li>';

        if ( is_category() )
        {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
            preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i',get_category_parents( $cat, TRUE, "" ),$a_link_array);
            $a_link_array=$a_link_array[0];
            foreach ( $a_link_array as $item ) {
                echo '<li>'.$item.'</li>';
            }
        }
        elseif ( is_archive() && !is_category() )
        {
            echo "<li>Archives</li>";
        }
        elseif ( is_search() ) {

            echo "<li>Search Results</li>";
        }
        elseif ( is_404() )
        {
            echo "<li>404 Not Found</li>";
        }
        elseif ( is_single() )
        {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
            preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i',get_category_parents( $category_id, TRUE, "" ),$a_link_array);
            $a_link_array=$a_link_array[0];
            foreach ( $a_link_array as $item ) {
                echo '<li>'.$item."</li>";
            }
            echo '<li><strong>'.the_title('','', FALSE)."</strong></li>";
        }
        elseif ( is_page() )
        {
            $post = $wp_query->get_queried_object();

            if ( $post->post_parent == 0 ){

                echo "<li><strong>".the_title('','', FALSE)."</strong></li>";

            } else {
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);

                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li><a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                    } else {
                        echo '<li><strong>'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</strong></li>';
                    }
                }
            }
        }

// End the UL
        echo "</ul>";
        echo "</nav>";
    }
}
/**
 * 获取home_path
 * $abbr [是否需要abbr] 1需要 0不需要
 * @author zhuoyue
 */
function get_full_path ($abbr = 0) {
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    $domain = $_SERVER['HTTP_HOST'];

    $path = $http_type.$domain;
    if($abbr = 1) {
        $abbr = ifEmptyText(get_query_var('lang'));
        if(!empty($abbr)) {
            $path .= '/'.$abbr;
        }
    }
    return $path;
}
/**
 * 获取站点域名 不带.com
 * $_SERVER php超全局变量
 * eg ：www.tonpal.com | tonpal.com
 * echo : tonpal
 * @author zhuoyue
 */
function get_host_name () {
    $host = explode('.',$_SERVER['HTTP_HOST']);
    if(count($host) == 2){
        $host = $host[0];
    } elseif ( count($host) >2 ) {
        $host = $host[1];
    }
    echo $host;
}

/**
 * 获取首页url
 * 因为本站涉及多语种 需要对home_url() 做二次封装
 * @author zhuoyue
 */
function get_lang_home_url () {
    $home_url = home_url();
    return $home_url;
}
/**
 * 获取当前页面url
 * 多语种所需
 * @author zhuoyue
 */
function get_lang_page_url () {
    global $wp; // Class_Reference/WP 类实例
    return get_full_path().add_query_arg($wp->request);
}
/**
 * 获取语言数据
 * @author zhuoyue
 */
function get_languages(){
    $data = Db::table('wp_language')->where('status','1')->select();
    return $data;
}

function get_category_objects($parent_id)
{
    $object = get_term_children($parent_id,'category');

    $condition = [];
    foreach($object as $id){
        $condition[] = 'term_taxonomy_id = '.$id;
    }

    $condition_str = implode(' OR ',$condition);

    global $wpdb;


    $result = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE ($condition_str)");

    $object_arr= [];
    foreach($result as $object){
        $object_arr[] = $object->object_id;
    }
    return $object_arr;
}
function custom_posts_per_page($query){
    if(is_archive()){
        global $wp;
        $slug = $wp->request;
        $slug = explode('/',$slug);

        if (empty(get_query_var('lang'))) {
            $slug = $slug[0];
        } else {
            $slug = $slug[1];
        }
        if ( $slug === 'product' ) {
            $query->set('posts_per_page',12);
        }
        else if ( $slug === 'news' ) {
            $query->set('posts_per_page',10);
        }
    }
}
add_action('pre_get_posts','custom_posts_per_page');


// 祛除摘要自动添加分段
remove_filter( 'the_excerpt', 'wpautop' );

// WordPress 标题中的横线“-”被转义成“–”的问题
remove_filter('the_title', 'wptexturize');
remove_filter('wp_title', 'wptexturize');
remove_filter('single_post_title', 'wptexturize');