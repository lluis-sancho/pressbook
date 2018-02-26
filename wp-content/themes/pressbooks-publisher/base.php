<!-- TODO[cmuino]: pantalla index -->

<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

// Bypass wrapper for templates within Pressbooks core.
if ( strpos( Wrapper\template_path(), 'plugins/pressbooks/templates' ) ) {
	include Wrapper\template_path();
} else { ?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body class="container">
    <div class="row">
      <div class="col-md-12">
        <img src="http://tecmerin.es/provisional/wp-content/uploads/2015/02/slide-cuadernos2.png"></img>
      </div>
    </div>

    <br/>
    <br/>

    <div class="row">
      <div class="col-md-12">
        <?php include Wrapper\template_path(); ?>
      </div>
    </div>
    
  </body>
</html>
<?php }
