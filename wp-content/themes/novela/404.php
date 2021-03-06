<?php
get_header();
?>
<section class="page-section page-section-error">

    <header class="error-header">
        <h1>Error 404</h1>
    </header>


    <div class="error404-message">
        <p><?php _e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.', 'novela') ?></p>
    </div>

    <div class="error404-search">
        <?php get_search_form(); ?>
    </div>

</section>

<?php get_footer(); ?>