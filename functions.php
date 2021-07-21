<?php


function my_enqueue_styles()
{
	wp_register_style('ress', '//unpkg.com/ress/dist/ress.min.css', array(), false, 'all');
	wp_register_style('style', get_stylesheet_uri(), array('ress'), false, 'all');
	wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');


// アイキャッチ画像
add_theme_support('post-thumbnails');


// ページネーション
function pagination($pages = '', $range = 2)
{
	$showitems = ($range * 2) + 1;

	// 現在のページ数
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}

	// 全ページ数
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}

	// ページ数が2ぺージ以上の場合のみ、ページネーションを表示
	if (1 != $pages) {
		echo '<div class="pagenation">';
		echo '<ul>';
		// 1ページ目でなければ、「前のページ」リンクを表示
		if ($paged > 1) {
			echo '<li class="prev"><a href="' . get_pagenum_link($paged - 1) . '">前のページ</a></li>';
		}

		// ページ番号を表示（現在のページはリンクにしない）
		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				if ($paged == $i) {
					echo '<li class="active">' . $i . '</li>';
				} else {
					echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
				}
			}
		}

		// 最終ページでなければ、「次のページ」リンクを表示
		if ($paged < $pages) {
			echo '<li class="next"><a href="' . get_pagenum_link($paged + 1) . '">次のページ</a></li>';
		}
		echo '</ul>';
		echo '</div>';
	}
}

// ウィジェット機能
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'サイドバー',
		'id' => 'sidebar',
		'description' => 'サイドバーウィジェット',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="side-title">',
		'after_title' => '</h3>'
	));
}

// 検索対象
function search_filter($query)
{
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts', 'search_filter');
