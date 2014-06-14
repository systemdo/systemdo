<?php
    remove_filter( 'pre_get_posts', 'cosmo_posts_per_archive' );
    get_header();
?>
<?php
    get_ads('logo');
?>
<section id="main">
    <div class="container">
        <div class="container-wrapper">
            <?php 
            global $ajax_link;
            $ajax_link = true;
            front_page_content(); ?>
        </div>
    </div>    
</section>
<?php get_footer(); ?>