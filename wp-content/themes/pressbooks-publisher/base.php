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
  
  <body>
    <!--
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            <img src="wp-content/uploads/assets/images/logo.png"/>
            <img src="wp-content/uploads/assets/images/logo_2.png"/>
          </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <a class="navbar-brand" href="#">
              <img src="wp-content/uploads/assets/images/uc3m.png"/>
            </a>
          </ul>
        </div>
      </div>
    </nav>
    -->

    <div class="container">
      
      <?php
        if (htmlspecialchars($_GET["dossier"]) != "true") {
      ?>
        <div class="jumbotron">
          <!--<img class="img-responsive" src="wp-content/uploads/assets/images/logo_books.png" style="max-height: 50px;"></img>-->
          <blockquote>
            <h4>Prólogo de la colección. Manuel Palacio</h4>
            <p>El Grupo de Investigación “Televisión-Cine: memoria, representación e industria (TECMERIN)” fue fundado en 2006 en el seno de la Universidad Carlos III de Madrid. El grupo, integrado por docentes e investigadores del Área de Comunicación Audiovisual, ha buscado a lo largo de estos años profundizar en aspectos poco desarrollados por las metodologías de análisis del audiovisual en España y en áreas tan diversas como los estudios televisivos y fílmicos, la economía política, la geopolítica del audiovisual, las representaciones sociales y las tecnologías de la imagen. La colección Cuadernos Tecmerin supone un nuevo paso adelante para el grupo, que cuenta así con su propio espacio editorial para la publicación de los resultados de las diferentes líneas de investigación desarrolladas. Además, esta colección adopta una forma dual, siendo editada en papel y como libro electrónico disponible en la página web del grupo (www.uc3m.es/tecmerin). El ímpetu para los primeros volúmenes que van a integrar la colección nace del interés del grupo en el concepto historiográfico de lo que se conoce internacionalmente como History from Below. De esta manera, los Cuadernos Tecmerin se conciben como una serie de trabajos en los que toman la palabra aquellos y aquellas cuya voz habitualmente no se escucha cuando se elaboran los relatos históricos hegemónicos, en la certeza que proporcionan nuevas maneras de entender el pasado y la memoria. Creemos con ello mantener (y restituir) la memoria y la identidad audiovisual de nuestro país a través de las fuentes y testimonios orales.</p>
            <footer>M. Palacio es catedrático de Comunicación Audiovisual e Investigador Principal del Grupo TECMERIN</footer>
          </blockquote>
        </div>
        
      <?php } ?>

      <div class="row ss-item">
        <?php include Wrapper\template_path(); ?>
      </div>

      <br/>
      <br/>
    
    </div>
  </body>


  <style type="text/css">
    .navbar-header {
      height: 60px;
    }
    .navbar-brand img {
      display: inline-block;
      height: 35px;
    }
    blockquote p {
      font-size: 12px !important;
      text-align: justify;
    }
    blockquote footer {
      font-size: 14px !important;
    }
    .jumbotron {
      margin-top: 40px;
      background-color: #dcdcdc;
      padding-bottom: 5px;
      padding-top: 25px;
    }
    .ss-item .ss-item-text{
      background-color:white;
      text-align:center;
      padding: 10px 20px;
      border-radius:0 0 5px 5px;
      font-weight:bold;
    }
    .ss-item img{
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      width:300px;
      border-radius:5px 5px 0 0;
      opacity:0.8;
      filter: alpha(opacity=80);
    }


  </style>
</html>
<?php }
