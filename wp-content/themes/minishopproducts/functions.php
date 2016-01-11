<?php
/**
 * Name: minishop
 */


// регистрируем файл стилей и добавляем его в очередь
function register_template_styles() {
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'bootstrap' );

}

add_action( 'wp_enqueue_scripts', 'register_template_scripts' );
add_action( 'wp_enqueue_scripts', 'register_template_styles' );
function register_template_scripts() {

	wp_enqueue_script( 'jquery', 'jquery' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js' );
	wp_enqueue_script( 'bootstrapValidator', get_template_directory_uri() . '/js/jquery.validate.min.js' );
	wp_enqueue_script( 'bay_validation_script', get_template_directory_uri() . '/js/bay_validation_script.js' );
}

function wp_bs_pagination( $pages = '', $range = 4 ) {

	$showitems = ( $range * 2 ) + 1;

	global $paged;

	if ( empty( $paged ) ) {
		$paged = 1;
	}


	if ( $pages == '' ) {

		global $wp_query;

		$pages = $wp_query->max_num_pages;

		if ( ! $pages ) {

			$pages = 1;

		}

	}


	if ( 1 != $pages ) {

		echo '<div class="text-center">';
		echo '<nav><ul class="pagination col-lg-12 col-md-12 col-sm-12 col-xs-12"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page ' . $paged . ' of ' . $pages . '</span></span></li>';

		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( 1 ) . "' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";
		}

		if ( $paged > 1 && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $paged - 1 ) . "' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous</span></a></li>";
		}


		for ( $i = 1; $i <= $pages; $i ++ ) {

			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

				echo ( $paged == $i ) ? "<li class=\"active\"><span>" . $i . " <span class=\"sr-only\">(current)</span></span>

    </li>" : "<li><a href='" . get_pagenum_link( $i ) . "'>" . $i . "</a></li>";

			}

		}


		if ( $paged < $pages && $showitems < $pages ) {
			echo "<li><a href=\"" . get_pagenum_link( $paged + 1 ) . "\"  aria-label='Next'><span class='hidden-xs'>Next </span>&rsaquo;</a></li>";
		}

		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<li><a href='" . get_pagenum_link( $pages ) . "' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";
		}

		echo "</ul></nav>";
		echo "</div>";
	}

}

function page_bay() {


	$page = '<form  method="post" name="bay-form" id="bay-form"  action="' . home_url( '/result' ) . '"><div class="form-group"><select   name="post_name" id="post_name" class="form-control">';

	$posts_name = '';

	$posts = get_posts( array(
		'numberposts'    => 5, // тоже самое что posts_per_page
		'offset'         => 0,
		'category'       => '',
		'orderby'        => 'post_date',
		'order'          => 'DESC',
		'include'        => '',
		'exclude'        => '',
		'meta_key'       => '',
		'meta_value'     => '',
		'post_type'      => 'MiniShopProducts',
		'post_mime_type' => '', // image, video, video/mp4
		'post_parent'    => '',
		'post_status'    => 'publish'
	) );

	foreach ( $posts as $post ) {
		$posts_name .= '<option value="' . $post->post_name . '">' . $post->post_name . '</option>';
	}

	$page .= $posts_name;
	$page .= '</select></div><div class="form-group">';
	$page .= '<select   name="term"    id="term" class="form-control">';


	$terms = get_terms( array( 'MiniShopOrdersDelivery' ), array(
		'orderby'                => 'id',
		'order'                  => 'ASC',
		'hide_empty'             => false,
		'exclude'                => array(),
		'exclude_tree'           => array(),
		'include'                => array(),
		'number'                 => '',
		'fields'                 => 'all',
		'slug'                   => '',
		'parent'                 => '',
		'hierarchical'           => true,
		'child_of'               => 0,
		'get'                    => '',
		// ставим all чтобы получить все термины
		'name__like'             => '',
		'pad_counts'             => false,
		'offset'                 => '',
		'search'                 => '',
		'cache_domain'           => 'core',
		'name'                   => '',
		// str/arr поле name для получения термина по нему. C 4.2.
		'childless'              => false,
		// true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
		'update_term_meta_cache' => true,
		// подгружать метаданные в кэш
		'meta_query'             => '',
	) );

	foreach ( $terms as $term ) {
		$page .= '<option value="' . $term->term_id . '">' . $term->name . '</option>';
	}
	$page .= '</select></div>';

	$current_user = wp_get_current_user();
	if ( 0 == $current_user->ID ) {
		$page .= '<div class="form-group"><input type="text" name="uname" id="uname"   class="form-control" placeholder="ФИО"></div>';
		$page .= '<div class="form-group"><input type="email" name="email" id="email" class="form-control" placeholder="email"></div>';

	} else {


		$page .= '<div class="form-group"><input type="text" name="uname" id="uname"    class="form-control"  placeholder="ФИО" ';

		( $current_user->user_firstname == null && $current_user->user_lastname == null ) ?: $page .= 'value="' . $current_user->user_firstname . ' ' . $current_user->user_lastname . '"';


		$page .= '></div>';


		$page .= '<div class="form-group"><input type="email" name="email" id="email"   class="form-control"  placeholder="email" ';

		( $current_user->user_email == null ) ?: $page .= 'value="' . $current_user->user_email . '"';

		$page .= '></div>';

	}


	$page .= '<div class="form-group">  <input type="submit" class="btn btn-default" value="Заказать"></div></div></form>';


	return $page;

}


add_shortcode( 'page_bay', 'page_bay' );


function page_result() {
	try {

		if ( empty( $_REQUEST['post_name'] ) ) {
			throw new Exception( 'Товар.' );
		} else {
			$post_name = sanitize_text_field( $_REQUEST['post_name'] );
		}
		if ( empty( $_REQUEST['term'] ) ) {
			throw new Exception( 'Способ доставки.' );
		} else {
			$term = sanitize_text_field( $_REQUEST['term'] );
		}
		if ( empty( $_REQUEST['uname'] ) ) {
			throw new Exception( 'Заполните ФИО.' );
		} else {
			$uname = sanitize_text_field( $_REQUEST['uname'] );
		}
		if ( empty( $_REQUEST['email'] ) ) {
			throw new Exception( 'Почта.' );
		} else {
			$email = sanitize_email( $_REQUEST['email'] );
		}


		$post_content = $post_name . ' ' . $uname . ' ' . $email;

		$term_processed = get_term_by( 'slug', 'processed', 'MiniShopOrdersStatus' );

		$post_data = array(
			'post_title'    => wp_strip_all_tags( 'Заказ' ),
			'post_content'  => $post_content,
			'post_type'     => 'minishoporders',
			'post_status'   => 'Обрабатывается',
			'post_author'   => $email,
			'post_status'   => 'private',
			'tax_input'     => array(
				'MiniShopOrdersDelivery' => array( $term ),
				'MiniShopOrdersStatus'   => array( $term_processed->term_id )
			),
			'post_category' => array( 8, 39 )
		);


		$post_id = wp_insert_post( $post_data );

		if ( $post_id == 0 ) {
			throw new Exception( 'Ошибка заказа.' );
		}


	} catch ( Exception $e ) {
		return 'Ошибка: ' . $e->getMessage() . "\n";
	}


	return "Покупка завершина!";

}

add_shortcode( 'page_result', 'page_result' );