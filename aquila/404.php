<?php

/**
 * The template for displaying 404 pages (Not Found)
 */
get_header();

?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <div class="page-header">
            <h1 class="page-title"><?php _e('Not Found', 'aquila'); ?></h1>
        </div>

        <div class="page-wrapper">
            <div class="page-content">
                <h2><?php _e('This is somewhat embarrassing, isn’t it?', 'aquila'); ?></h2>
                <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'aquila'); ?>
                </p>
            </div>
        </div>


    </div>
</div>

<?php
get_footer();
?>