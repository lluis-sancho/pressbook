<?php

function sdesigns_custom_styles() {
global $novela_data;
?>

<style type="text/css">


<?php
if( !empty( $novela_data['sidebar-bg']['url']) ) : ?>
/* Sidebar Background Image */
.sb-slidebar {
    background-image: url('<?php echo $novela_data['sidebar-bg']['url']; ?>');
}
<?php
endif;
?>

<?php
if( !empty( $novela_data['custom-css']) ) {
  echo $novela_data['custom-css'];
}
?>
</style>

<?php }
add_action( 'wp_head', 'sdesigns_custom_styles', 100 );