<?php
/**
 * メインテンプレートファイル
 *
 * @package Kanucard_LP
 */

get_header();
?>

<main id="main" class="site-main">
    <?php
    if ( is_front_page() && is_home() ) {
        // ホームページの場合、ランディングページテンプレートを読み込み
        get_template_part( 'template-parts/content', 'landing' );
    } else {
        // 通常のループ
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;

            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
    }
    ?>
</main>

<?php
get_footer();