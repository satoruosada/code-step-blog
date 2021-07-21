<form method="get" id="searchform" action="<?php echo esc_url(home_url()); ?>">
    <input type="text" name="s" id="s" placeholder="キーワードで検索する">
    <button type="submit">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/common/search.png" alt="">
    </button>
</form>