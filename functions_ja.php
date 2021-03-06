<?php
/**
 * Twenty Twelve functions and definitions.
 * Twenty Twelve 関数と定義。
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 * テーマをセットアップし、テーマ内でカスタムなテンプレートタグとして利用される
 * いくつかのヘルパー関数を提供します。その他、WordPress 内のアクションと
 * フィルターフックにアタッチされ、主要な機能を変更します。
 * 
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 * 子テーマを作成する場合 (http://wpdocs.sourceforge.jp/テーマの作成 や 
 * http://wpdocs.sourceforge.jp/Child_Themes を参照)、 特定の関数 (function_exists() 呼び出しで
 * ラップされています) は子テーマの functions.php ファイルで先に定義することによって
 * オーバーライドできます。子テーマの functions.php ファイルは親テーマのファイルよりも
 * 先にインクルードされるため、子テーマの関数が使用されます。
 * 
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 * オーバーライドできない関数 (function_exists()でラップされていないもの) はフィルターや
 * アクションフックにアタッチされています。
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 * フック、アクション、フィルターに関する詳細は http://wpdocs.sourceforge.jp/プラグイン_API を参照してください。
 * 
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 * テーマのデザインとスタイルシートをベースにしたコンテンツ幅のセットアップ。
 * 
 * ***
 * 投稿や固定ページなどに挿入するメディア (画像やビデオ) の幅、oEmbed の幅を設定
 * http://wpdocs.sourceforge.jp/Embeds
 * 
 * TODO:ちょっと優先順位が不明なので要調査
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 * テーマのデフォルト値をセットアップし、Twenty Twelve でサポートする WordPress 
 * の様々な機能を登録。
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @uses load_theme_textdomain() 翻訳/ローカライゼーションのサポート
 * @uses add_editor_style() ビジュアルエディターのスタイルシートを追加
 * @uses add_theme_support() 投稿サムネイル (アイキャッチ画像)、自動フィードリンク、
 * カスタム背景、投稿フォーマットのサポートを追加
 * @uses register_nav_menu() ナビゲーションメニューのサポートを追加
 * @uses set_post_thumbnail_size() カスタム投稿サムネイルのサイズを設定
 * *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 * Twenty Twelve で言語リソース (翻訳ファイル) を利用できるようにする。
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 * 言語リソース (翻訳ファイル) は /languages/ ディレクトリに追加できます。
	 * Twenty Twelve をベースにテーマを作成する場合、エディターの置換機能を利用して
	 * すべてのテンプレートファイル内の 'twentytwelve' を自分のテーマ名に変更します。
	 * 
	 * TODO: 言語リソースの説明
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	// テーマのスタイルと合わせるため editor-style.css でビジュアルエディターのスタイルをつける。
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	// 投稿とコメント用の RSS フィードリンクを <head> に追加する。
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	// 様々な投稿フォーマットをサポート。
	// 
	// TODO: 投稿フォーマットの説明
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	// このテーマでは wp_nav_menu() を一つの場所で利用する。
	// 
	// TODO: wp_nav_menu()の説明
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 * このテーマではカスタム背景色と背景画像をサポートしていて、ここでは
	 * デフォルトの背景色を設定している。
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	// このテーマでは、"標準"の投稿に表示させるアイキャッチ画像用にカスタムな画像サイズを使用している。
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop 高さの制限をなくして、ソフトクロップ TODO ソフトクロップ？
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Adds support for a custom header image.
 * カスタムなヘッダー画像のサポートを追加。
 * 
 * TODO:custom-header.phpも解説するかぁ？
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 * フロントエンド用のスクリプトとスタイルをキューに加える。
 * 
 * TODO: http://codex.wordpress.org/Function_Reference/wp_enqueue_script を訳す
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 * スレッドコメント (有効時) を使うサイトをサポートするために
	 * コメントフォームのあるページに JavaScript をする。
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 * 小さなスクリーン用にナビゲーションメニューの表示/非表示を扱うための JavaScript を追加する。
	 */
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 * 特別なフォント CSS ファイルを読み込む。
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 * Open sans はデフォルトではローカライズされている。このフォントで
	 * サポートされていない文字を使用する言語ではこのフォントを無効化できる。
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * 子テーマで無効化するには use wp_dequeue_style() を使用する
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'twentytwelve-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	/* 翻訳者の方へ: みなさんの言語で Open Sans でサポートされていない文字がある場合、
	 * これを 'off' にしてください。翻訳はしないでください。
	 * TODO: _X()の解説
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		/* 翻訳者の方へ: ご自分の言語用の Open Sans 文字サブセットを追加するには、ここを
		  'greek', 'cyrillic' もしくは 'vietnamese' にしてください。ご自分の言語へは訳さないでください */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'twentytwelve-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.
	 * メインスタイルシートの読み込み。
	 */
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 * Internet Explorer 用スタイルシートの読み込み。
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 * 閲覧してるページをもとにして head の出力用にかっこ良くフォーマットされた
 * より具体的なタイトル要素テキストを生成する。
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	// サイト名を追加する。
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	// ホーム/トップページ用にサイトディスクリプションを追加する。
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	// 必要に応じてページ番号を追加する。
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 * wp_nav_menu() のフォールバック -- wp_page_menu() -- にホームへのリンクを表示させる。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 * メインウィジェットエリアとトップページ用ウィジェットエリアを登録する。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 * 前後のページがあればそのページへのナビゲーションを表示する。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * コメントとピンバックのテンプレート。
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 * コメントテンプレートを変更せずに子テーマでこのウォーカーを上書きするには
 * たんに独自の twentytwelve_comment() を作成するだけでその関数が代わりに使用される。
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 * コメント表示用の wp_list_comments() によるコールバックとして利用される。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
		// トラックバックは通常のコメントとは違う形で表示する。
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		// 通常のコメントを続行する。
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						// 当該記事の作成者がコメントの投稿者の場合に、それを見た目で分かるようにする。
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						/* 翻訳者の方へ: 1: 日にち, 2: 時刻 */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check コメントタイプチェック終わり 
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * 表示中の投稿のメタ情報を HTML で出力する: カテゴリー、タグ、パーマリンク、作成者、日付。
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 * 子テーマで上書きするには独自の twentytwelve_entry_meta() を作成する。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma. 
	// 翻訳者の方へ: リスト項目間に使われ、コンマの後ろにスペースがあります。
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma. 
	// 翻訳者の方へ: リスト項目間に使われ、コンマの後ろにスペースがあります。
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	//翻訳者の方へ: 1 はカテゴリー、2 はタグ、3 は日付、4 は投稿作成者名。
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 * 以下を表示するため、WordPress のデフォルトのボディクラスを拡張する:
 * 1. サイドバーにアクティブなウィジェットがない場合や全幅テンプレートの
 *    ときに全幅のレイアウトを使用
 * 2. フロントページテンプレート: サムネイル使用時とウィジェットエリアでの
 *    サイドバーの数
 * 3. 背景色が白もしくは空(から)の時にレイアウトとスペーシングを変更するため
 * 4. カスタムフォント有効時
 * 5. 投稿者が単独か複数か
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load. 
	// font CSS が読み込みのキューにあるときだけカスタムフォントのクラスを有効にする
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 * 全幅とシングルアタッチメントテンプレートの時とサイドバーにアクティブな
 * ウィジェットがないときにコンテンツ幅の値を調整する。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * テーマカスタマイザー用にサイトタイトルとディスクリプションで postMessage サポートを追加する。
 * TODO: postMessageとはなんぞや？
 * FYI: https://codex.wordpress.org/Theme_Customization_API
 * 
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 * テーマカスタマイザーで変更を非同期にプレビューさせるために JS ハンドラーをバインドする。
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );
