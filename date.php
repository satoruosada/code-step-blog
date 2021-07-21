<?php get_header(); ?>

<div id="container" class="wrapper">
    <main>
        <h1 class="page-title">
            <?php echo get_query_var('year') . '年' . get_query_var('monthnum') . '月'; ?>
        </h1>

        <?php if (have_posts()) : ?>
            <?php get_template_part('loop'); ?>

            <?php
            if (function_exists("pagination")) {
                pagination($wp_query->max_num_pages);
            }
            ?>
        <?php endif; ?>

    </main>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>