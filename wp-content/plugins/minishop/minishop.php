<?php
/*
Plugin Name: MiniShop
Plugin URI: https://github.com/bigturtle88/
Description: MiniShop plugin
Version: 1.0
Author: Vyacheslav bigturtle@i.ua
Author URI: https://github.com/bigturtle88/
*/

if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
    die('You are not allowed to call this page directly.');
}
if (!class_exists(MiniShop)) {
    class MiniShop
    {
        var $page_title;
        var $menu_title;
        var $access_level;
        var $add_page_to;
        var $short_description;
        var $path_to_php_file_plugin;


        public function __construct()
        {


            $this->page_title = 'MiniShop';
            $this->menu_title = 'MiniShop';
            $this->access_level;
            $this->add_page_to;
            $this->short_description;
            $this->path_to_php_file_plugin = __FILE__;


            add_action('init', array(&$this, 'MiniShopProducts'));
            add_action('init', array(&$this, 'MiniShopOrders'));
            add_action('init', array(&$this, 'create_taxonomy'), 0);
      //   add_filter('template_include', array(&$this, 'minishop_template'), 99);
        }

        public function MiniShopInstall()
        {


            global $wp_version;

            if (version_compare($wp_version, '3.4', '<')) {

                wp_die('This plugin requires WordPress version 3.5 or higher.');

            }


        }

        public function MiniShopDeactivate()
        {
        }

        public function MiniShopUninstall()
        {

        }

        function MiniShopProducts()
        {
            register_post_type('MiniShopProducts',
                array(
                    'labels' => array(
                        'name' => 'Mini Shop Products',
                        'singular_name' => 'MiniShopProducts',
                        'add_new' => 'Add New',
                        'add_new_item' => 'Add New Product',
                        'edit' => 'Edit',
                        'edit_item' => 'Edit Product',
                        'new_item' => 'New Product',
                        'view' => 'View',
                        'view_item' => 'View Product',
                        'search_items' => 'Search Product',
                        'not_found' => 'No Product found',
                        'parent' => 'Parent Product'
                    ),
                    'public' => true,
                    'menu_position' => 77,
                    'supports' => array('title', 'editor', 'thumbnail'),
                    'taxonomies' => array('post_tag', 'category'),

                    'has_archive' => true
                )
            );


        }

        function MiniShopOrders()
        {
            register_post_type('MiniShopOrders',
                array(
                    'labels' => array(
                        'name' => 'Mini Shop Orders',
                        'singular_name' => 'MiniShopOrders',
                        'add_new' => 'Add New',
                        'add_new_item' => 'Add New Order',
                        'edit' => 'Edit',
                        'edit_item' => 'Edit Order',
                        'new_item' => 'New Order',
                        'view' => 'View',
                        'view_item' => 'View Order',
                        'search_items' => 'Search Order',
                        'not_found' => 'No Order found',

                    ),
                    'public' => true,
                    'menu_position' => 77,
                    'supports' => array('title', 'editor', 'thumbnail'),
                    'taxonomies' => array('MiniShopOrdersDelivery', 'MiniShopOrdersStatus'),

                    'has_archive' => true
                )
            );
        }


        function create_taxonomy()
        {

            $labels = array(
                'name' => _x('Способ доставки', 'taxonomy general name'),
                'singular_name' => _x('Способ доставки', 'taxonomy singular name'),
                'search_items' => __('Search Delivery'),
                'popular_items' => __('Popular Delivery'),
                'all_items' => __('Способ доставки'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Delivery'),
                'update_item' => __('Update Delivery'),

                'new_item_name' => __('New Delivery Name'),
                'separate_items_with_commas' => __('Separate Delivery with commas'),
                'add_or_remove_items' => __('Add or remove Delivery'),
                'choose_from_most_used' => __('Choose from the most used Delivery'),
                'menu_name' => __('Способ доставки'),
            );

            register_taxonomy('MiniShopOrdersDelivery', 'MiniShopOrders', array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => 'MiniShopOrdersDelivery'),
            ));


            $labels = array(
                'name' => _x('Статус товара', 'taxonomy general name'),
                'singular_name' => _x('Статус', 'taxonomy singular name'),
                'search_items' => __('Search Order'),
                'popular_items' => __('Popular Order'),
                'all_items' => __('All Order'),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __('Edit Order'),
                'update_item' => __('Update Order'),
                'add_new_item' => __('Add New Order'),
                'new_item_name' => __('New Order Name'),
                'separate_items_with_commas' => __('Separate Order with commas'),
                'add_or_remove_items' => __('Add or remove Order'),
                'choose_from_most_used' => __('Choose from the most used Order'),
                'menu_name' => __('Статус товара'),
            );

            register_taxonomy('MiniShopOrdersStatus', 'MiniShopOrders', array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => 'MiniShopOrdersStatus'),
            ));

            $parent_term = term_exists('MiniShopOrdersDelivery'); // вернет массив, если таксономия существует

            $parent_term_id = $parent_term['term_id']; // получим числовое значения термина

            wp_insert_term(
                'Самовывоз', // новый термин
                'MiniShopOrdersDelivery', // таксономия
                array(
                    'description' => 'Способ доставки "Cамовывоз".',
                    'slug' => 'Pickup',
                    'parent' => $parent_term_id
                )
            );
            wp_insert_term(
                'Доставка почтой', // новый термин

                'MiniShopOrdersDelivery', // таксономия
                array(
                    'description' => 'Способ доставки "Доставка почтой".',
                    'slug' => 'DeliveryByMail',
                    'parent' => $parent_term_id
                )
            );
            wp_insert_term(
                'Курьерская доставка', // новый термин
                'MiniShopOrdersDelivery', // таксономия
                array(
                    'description' => 'Способ доставки "Курьерская доставка".',
                    'slug' => 'ExpressDelivery',
                    'parent' => $parent_term_id
                )
            );


            $parent_term = term_exists('MiniShopOrdersStatus'); // вернет массив, если таксономия существует

            $parent_term_id = $parent_term['term_id']; // получим числовое значения термина
            wp_insert_term(
                'Обрабатывается', // новый термин
                'MiniShopOrdersStatus', // таксономия
                array(
                    'description' => 'Статус "Обрабатывается".',
                    'slug' => 'Processed',
                    'parent' => $parent_term_id
                )
            );

            wp_insert_term(
                'Отправлен', // новый термин
                'MiniShopOrdersStatus', // таксономия
                array(
                    'description' => 'Статус "Отправлен".',
                    'slug' => 'Sent',
                    'parent' => $parent_term_id
                )
            );

            wp_insert_term(
                'Отклонен', // новый термин
                'MiniShopOrdersStatus', // таксономия
                array(
                    'description' => 'Статус "Отклонен".',
                    'slug' => 'Rejected',
                    'parent' => $parent_term_id
                )
            );


        }


    /*    function minishop_template($template)
        {
            if (get_post_type() == 'minishopproducts' or is_home()) {


                if ($template_path = locate_template('minishopproducts')) {

                    $template = load_template($template_path);

                } else {

                    require_once(dirname(__FILE__) . '/minishop_template/functions.php');

                    $template_path = dirname(__FILE__) . '/minishop_template/minishopproducts.php';

                    $template = load_template($template_path);

                }


            }
            return $template;

        }*/


    }

}

if (class_exists('MiniShop')) {

    register_activation_hook(__FILE__, array('MiniShop', 'MiniShopInstall'));
    register_deactivation_hook(__FILE__, array('MiniShop', 'MiniShopDeactivate'));
    register_uninstall_hook(__FILE__, array('MiniShop', 'MiniShopUninstall'));


    $MiniShop = new MiniShop();

}

